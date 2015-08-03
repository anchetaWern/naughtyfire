<?php

use Phinx\Migration\AbstractMigration;

class CreateSettingsTable extends AbstractMigration
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
        $table = $this->table('settings');
        $table->addColumn('name', 'string')
              ->addColumn('email', 'string')
              ->addColumn('twilio_sid', 'string')
              ->addColumn('twilio_token', 'string')
              ->addColumn('twilio_phonenumber', 'string')
              ->addColumn('mail_host', 'string')
              ->addColumn('mail_port', 'string')
              ->addColumn('mail_username', 'string')
              ->addColumn('mail_password', 'string')
              ->addColumn('subject', 'string')
              ->addColumn('msg_template', 'text')
              ->addColumn('time_before', 'string')
              ->create();
    }
}
