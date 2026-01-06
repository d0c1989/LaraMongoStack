<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Filesystem\Filesystem;

class MakeMongoModel extends Command
{
    protected $signature = 'make:mongo-model {name}';
    protected $description = 'Create a MongoDB model and its collection';

    public function handle()
    {
        $name = Str::studly($this->argument('name'));
        $collection = Str::snake(Str::pluralStudly($name));

        $path = app_path("Models/{$name}.php");

        if (file_exists($path)) {
            $this->error("Model {$name} already exists.");
            return Command::FAILURE;
        }

        // 1️⃣ Create model file
        (new Filesystem)->put($path, <<<PHP
<?php

namespace App\Models;

class {$name} extends MongoModel
{
    protected \$collection = '{$collection}';
}
PHP);

        // 2️⃣ Create MongoDB collection immediately
        DB::connection('mongodb')
            ->getMongoDB()
            ->createCollection($collection);

        $this->info("MongoDB model {$name} created.");
        $this->info("Collection '{$collection}' created.");

        return Command::SUCCESS;
    }
}
