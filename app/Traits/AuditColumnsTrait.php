<?php

namespace App\Traits;

use Illuminate\Database\Schema\Blueprint;

/**
 * Adds "who created / updated / deleted this row" bookkeeping columns to a
 * migration. Keeps every table consistent without copy-pasting the same
 * column + foreign key boilerplate everywhere.
 */
trait AuditColumnsTrait
{
    /**
     * Standard audit columns that point back to the admins table.
     */
    public function addAuditColumns(Blueprint $table): void
    {
        $table->unsignedBigInteger('created_by')->nullable();
        $table->unsignedBigInteger('updated_by')->nullable();
        $table->unsignedBigInteger('deleted_by')->nullable();

        $table->foreign('created_by')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('updated_by')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('deleted_by')->references('id')->on('admins')->onDelete('cascade')->onUpdate('cascade');
    }

    /**
     * Polymorphic variant for when the actor may be more than one model type.
     */
    public function addMorphedAuditColumns(Blueprint $table): void
    {
        $table->unsignedBigInteger('creater_id')->nullable();
        $table->string('creater_type')->nullable();
        $table->unsignedBigInteger('updater_id')->nullable();
        $table->string('updater_type')->nullable();
        $table->unsignedBigInteger('deleter_id')->nullable();
        $table->string('deleter_type')->nullable();
    }

    public function dropAuditColumns(Blueprint $table): void
    {
        $table->dropForeign(['created_by']);
        $table->dropForeign(['updated_by']);
        $table->dropForeign(['deleted_by']);

        $table->dropColumn('created_by');
        $table->dropColumn('updated_by');
        $table->dropColumn('deleted_by');
    }

    public function dropMorphedAuditColumns(Blueprint $table): void
    {
        $table->dropColumn(['creater_id', 'updater_id', 'deleter_id']);
        $table->dropColumn(['creater_type', 'updater_type', 'deleter_type']);
    }
}
