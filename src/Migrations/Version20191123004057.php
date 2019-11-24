<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191123004057 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lesson ADD training_id INT NOT NULL, ADD instructor_id INT NOT NULL, ADD date_time DATETIME NOT NULL, ADD location INT NOT NULL, ADD max_persons INT NOT NULL');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F3BEFD98D1 FOREIGN KEY (training_id) REFERENCES training (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F38C4FC193 FOREIGN KEY (instructor_id) REFERENCES person (id)');
        $this->addSql('CREATE INDEX IDX_F87474F3BEFD98D1 ON lesson (training_id)');
        $this->addSql('CREATE INDEX IDX_F87474F38C4FC193 ON lesson (instructor_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_34DCD1769851F543 ON person (login_name)');
        $this->addSql('ALTER TABLE registration ADD lesson_id INT NOT NULL, ADD member_id INT NOT NULL, ADD payment TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A7CDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id)');
        $this->addSql('ALTER TABLE registration ADD CONSTRAINT FK_62A8A7A77597D3FE FOREIGN KEY (member_id) REFERENCES person (id)');
        $this->addSql('CREATE INDEX IDX_62A8A7A7CDF80196 ON registration (lesson_id)');
        $this->addSql('CREATE INDEX IDX_62A8A7A77597D3FE ON registration (member_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F3BEFD98D1');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F38C4FC193');
        $this->addSql('DROP INDEX IDX_F87474F3BEFD98D1 ON lesson');
        $this->addSql('DROP INDEX IDX_F87474F38C4FC193 ON lesson');
        $this->addSql('ALTER TABLE lesson DROP training_id, DROP instructor_id, DROP date_time, DROP location, DROP max_persons');
        $this->addSql('DROP INDEX UNIQ_34DCD1769851F543 ON person');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A7CDF80196');
        $this->addSql('ALTER TABLE registration DROP FOREIGN KEY FK_62A8A7A77597D3FE');
        $this->addSql('DROP INDEX IDX_62A8A7A7CDF80196 ON registration');
        $this->addSql('DROP INDEX IDX_62A8A7A77597D3FE ON registration');
        $this->addSql('ALTER TABLE registration DROP lesson_id, DROP member_id, DROP payment');
    }
}
