<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared(
            'CREATE TRIGGER calculate_remaining_amount BEFORE INSERT ON payments FOR EACH ROW
                BEGIN
                    DECLARE total_paid DECIMAL;

                    -- Get the total paid for the user
                    SELECT COALESCE(SUM(amount_paid), 0) INTO total_paid FROM payments WHERE student_id = NEW.student_id;

                    -- Add the new amount to the total paid
                    SET total_paid = total_paid + NEW.amount_paid;     

                    IF total_paid > NEW.goal_amount THEN
                        SIGNAL SQLSTATE \'45000\' SET MESSAGE_TEXT = \'The total paid cannot be greater than the goal amount\';
                    END IF;
                    
                    -- show the total paid in the console
                    SET NEW.remaining_amount = NEW.goal_amount - total_paid; 
                END;
            '
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trigger_update_remaining_amount_payment');
    }
};
