<?php

use Phinx\Migration\AbstractMigration;

class CreateEventsTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     */
    public function change()
    {
        $table = $this->table('events');
        $table->addColumn('title', 'string')
              ->addColumn('date', 'date')
              ->addColumn('is_enabled', 'boolean')
              ->addColumn('is_recurring', 'boolean')
              ->create();
    }
}
