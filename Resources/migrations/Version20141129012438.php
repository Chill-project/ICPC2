<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141129012438 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("CREATE SEQUENCE Chapter_id_seq INCREMENT BY 1 MINVALUE 1 START 1;");
        $this->addSql("CREATE SEQUENCE Code_id_seq INCREMENT BY 1 MINVALUE 1 START 1;");
        $this->addSql("CREATE SEQUENCE Component_id_seq INCREMENT BY 1 MINVALUE 1 START 1;");
        $this->addSql("CREATE TABLE BlopEntity2 (id INT NOT NULL, customFieldData JSON NOT NULL, PRIMARY KEY(id));");
        $this->addSql("CREATE TABLE Adress (id INT NOT NULL, data VARCHAR(255) NOT NULL, PRIMARY KEY(id));");
        $this->addSql("CREATE TABLE Chapter (id INT NOT NULL, name JSON NOT NULL, slug VARCHAR(1) NOT NULL, PRIMARY KEY(id));");
        $this->addSql("CREATE TABLE Code (id INT NOT NULL, chapter_id INT DEFAULT NULL, component_id INT DEFAULT NULL, code VARCHAR(3) NOT NULL, name JSON NOT NULL, PRIMARY KEY(id));");
        $this->addSql("CREATE INDEX IDX_D7279FA6579F4768 ON Code (chapter_id);");
        $this->addSql("CREATE INDEX IDX_D7279FA6E2ABAFFF ON Code (component_id);");
        $this->addSql("CREATE TABLE Component (id INT NOT NULL, name JSON NOT NULL, slug VARCHAR(60) NOT NULL, PRIMARY KEY(id));");
        $this->addSql("ALTER TABLE Code ADD CONSTRAINT FK_D7279FA6579F4768 FOREIGN KEY (chapter_id) REFERENCES Chapter (id) NOT DEFERRABLE INITIALLY IMMEDIATE;");
        $this->addSql("ALTER TABLE Code ADD CONSTRAINT FK_D7279FA6E2ABAFFF FOREIGN KEY (component_id) REFERENCES Component (id) NOT DEFERRABLE INITIALLY IMMEDIATE;");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
