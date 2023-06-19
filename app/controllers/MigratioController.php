<?php
namespace app\components;

use yii\web\Controller;

class DockerMigration extends Controller {
    public $migrationPath = ['@app/migrations'];
}