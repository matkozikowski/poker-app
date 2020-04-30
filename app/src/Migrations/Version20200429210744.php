<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200429210744 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql(
            '
            INSERT INTO `api_user` (`email`, `roles`, `password`, `api_token`) 
            VALUES (?, ? , ?, ?);
            ',
            [
                'test@test.pl',
                '["ROLE_USER"]',
                '62UkE3xptjVSYcwPEAaRc9qum',
                '1ae833c09cf254cea63c2345f732c44810b6dd01afa42df4985350c18736f0cfdf2a3d2c6c0c92610cb772011edffcf33a8c9f79dd69f16417881bde',
            ]
        );
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        $this->addSql('DELETE FROM api_user WHERE email = "test@test.pl"');
    }
}
