<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230119215009 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE listas_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tarefas_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE usuarios_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE listas (id INT NOT NULL, descricao_lista VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE lista_usuario (lista_id INT NOT NULL, usuario_id INT NOT NULL, PRIMARY KEY(lista_id, usuario_id))');
        $this->addSql('CREATE INDEX IDX_CEB379006736D68F ON lista_usuario (lista_id)');
        $this->addSql('CREATE INDEX IDX_CEB37900DB38439E ON lista_usuario (usuario_id)');
        $this->addSql('CREATE TABLE tarefas (id INT NOT NULL, lista_id INT DEFAULT NULL, descricao_tarefa VARCHAR(255) NOT NULL, status_tarefa INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_30B98ED56736D68F ON tarefas (lista_id)');
        $this->addSql('CREATE TABLE usuarios (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nome VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EF687F2E7927C74 ON usuarios (email)');
        $this->addSql('ALTER TABLE lista_usuario ADD CONSTRAINT FK_CEB379006736D68F FOREIGN KEY (lista_id) REFERENCES listas (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE lista_usuario ADD CONSTRAINT FK_CEB37900DB38439E FOREIGN KEY (usuario_id) REFERENCES usuarios (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tarefas ADD CONSTRAINT FK_30B98ED56736D68F FOREIGN KEY (lista_id) REFERENCES listas (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE listas_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tarefas_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE usuarios_id_seq CASCADE');
        $this->addSql('ALTER TABLE lista_usuario DROP CONSTRAINT FK_CEB379006736D68F');
        $this->addSql('ALTER TABLE lista_usuario DROP CONSTRAINT FK_CEB37900DB38439E');
        $this->addSql('ALTER TABLE tarefas DROP CONSTRAINT FK_30B98ED56736D68F');
        $this->addSql('DROP TABLE listas');
        $this->addSql('DROP TABLE lista_usuario');
        $this->addSql('DROP TABLE tarefas');
        $this->addSql('DROP TABLE usuarios');
    }
}
