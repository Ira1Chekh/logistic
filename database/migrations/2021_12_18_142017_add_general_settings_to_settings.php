<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddGeneralSettingsToSettings extends SettingsMigration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->migrator->add('general.fuel_price', 30);
        $this->migrator->add('general.tax_percent', 20);
        $this->migrator->add('general.enterprise_percent', 10);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->migrator->delete('general.fuel_price');
        $this->migrator->delete('general.tax_percent');
        $this->migrator->delete('general.enterprise_percent');
    }
}
