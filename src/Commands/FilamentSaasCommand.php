<?php

namespace A2Insights\FilamentSaas\Commands;

use A2Insights\FilamentSaas\FilamentSaas;
use BezhanSalleh\FilamentShield\Support\Utils;
use Illuminate\Support\Facades\Hash;
use LaravelZero\Framework\Commands\Command;

class FilamentSaasCommand extends Command
{
    protected $signature = 'filament-saas:install';

    protected $description = 'Instala o Filament SaaS com menus interativos';

    public function handle(): void
    {
        $this->info('🚀 Iniciando instalação...');

        $enableTeams = $this->menu('Deseja ativar o recurso de Times?', [
            'yes' => 'Sim, quero usar times',
            'no' => 'Não, sem times',
        ])->setForegroundColour('green')
            ->setBackgroundColour('black')
            ->open();

        $useTeam = $enableTeams === 'yes';
        $team = null;

        if ($useTeam) {
            $teamName = $this->ask('Digite o nome do time', 'Time Principal');
            $team = FilamentSaas::getTeamModel()::create(['name' => $teamName]);
            $this->info("✅ Time {$team->name} criado!");
        }

        // Executa migrações e setup
        $this->call('optimize');
        $this->call('migrate:fresh', ['--force' => true]);
        $this->call('shield:setup');
        $this->call('shield:install', ['panel' => 'admin']);
        $this->call('shield:install', ['panel' => 'sysadmin']);
        $this->call('shield:generate', ['--all' => true, '--panel' => 'admin']);
        $this->call('shield:generate', ['--all' => true, '--panel' => 'sysadmin']);

        // Criar usuários com menu
        $this->createUserWithMenu('super_admin', $team);
        $this->createUserWithMenu('admin', $team);
        $this->createUserWithMenu('user', $team);

        $this->call('db:seed');
        $this->info('🎉 Instalação finalizada com sucesso!');
    }

    private function createUserWithMenu(string $role, $team = null)
    {
        $this->info("👤 Criando usuário para: {$role}");

        $name = $this->ask("Nome para {$role}", ucfirst($role));
        $email = $this->ask("Email para {$role}", "{$role}@filament-saas.dev");
        $password = $this->secret("Senha para {$role}") ?: '123456';

        $user = FilamentSaas::getUserModel()::forceCreate([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'team_id' => $team?->id,
        ]);

        $user->markEmailAsVerified();

        $roleName = match ($role) {
            'super_admin' => Utils::getSuperAdminName(),
            'admin' => 'admin',
            default => Utils::getPanelUserRoleName()
        };

        $roleModel = Utils::getRoleModel()::firstOrCreate(
            ['name' => $roleName],
            ['guard_name' => Utils::getFilamentAuthGuard()]
        );

        $roleModel->syncPermissions([]);
        $user->assignRole($roleName);

        $this->info("✅ {$role} criado: {$email} | senha: {$password}");
    }
}
