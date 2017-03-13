<?php

use yii\db\Migration;

/**
 * Handles adding role to table `user`.
 */
class m170313_084208_add_role_column_to_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('user', 'role', $this->integer()->defaultValue(1));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('user', 'role');
    }
}
