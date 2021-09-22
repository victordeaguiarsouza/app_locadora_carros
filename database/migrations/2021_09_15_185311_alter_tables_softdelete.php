<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTablesSoftdelete extends Migration
{

    public function up()
    {
        Schema::table('marcas', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('modelos', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('carros', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('clientes', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('locacoes', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('locacoes', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('carros', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('modelos', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

        Schema::table('marcas', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });

    }

}
