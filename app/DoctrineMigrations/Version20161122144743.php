<?php

namespace Application\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Wallabag\CoreBundle\Doctrine\WallabagMigration;

/**
 * Add the restricted_access internal setting for articles with paywall.
 */
class Version20161122144743 extends WallabagMigration
{
    public function up(Schema $schema)
    {
        $access = $this->container
            ->get('doctrine.orm.default_entity_manager')
            ->getConnection()
            ->fetchArray('SELECT * FROM ' . $this->getTable('craue_config_setting') . " WHERE name = 'restricted_access'");

        $this->skipIf(false !== $access, 'It seems that you already played this migration.');

        $this->addSql('INSERT INTO ' . $this->getTable('craue_config_setting') . " (name, value, section) VALUES ('restricted_access', 0, 'entry')");
    }

    public function down(Schema $schema)
    {
        $this->addSql('DELETE FROM ' . $this->getTable('craue_config_setting') . " WHERE name = 'restricted_access';");
    }
}
