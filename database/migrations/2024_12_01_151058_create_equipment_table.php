<?

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 255);
            $table->string('email', 255)->unique();
            $table->dateTime('birthdate');
            $table->string('gender', 255);
            $table->string('password', 255);
            $table->double('weight')->nullable();
            $table->double('height')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps(); // This will create 'created_at' and 'updated_at'
            $table->unsignedBigInteger('idMember');
            $table->unsignedBigInteger('idPayment');

            // Foreign key constraints
            $table->foreign('idMember')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('idPayment')->references('id')->on('payments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
