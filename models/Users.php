<?php

namespace app\models;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string|null $firstName
 * @property string|null $lastName
 *
 * @property UsersPhones[] $usersPhones
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstName'], 'string', 'max' => 20],
            [['lastName'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'name' => 'name'
        ];
    }

    public function addPhone($phones)
    {

        foreach ($phones as $phone){
            $userPhones = new UsersPhones();
            $userPhones->user_id = $this->id;
            $userPhones->phone = $phone;
            $userPhones->save();
        }

    }

    /**
     * Gets query for [[UsersPhones]].
     *
     * @return \yii\db\ActiveQuery
     */

    public function fields()
    {
        $fields = parent::fields();
        $fields['phone'] = function () {

            return $this->getUserPhone();

        };
        return $fields;
    }


    public function getUserPhone()
    {
        $rows = UsersPhones::find()->where(['user_id' => $this->id])->all();
        $phones = [];
        foreach ($rows as $row) {
            $phones[]=$row['phone'];
        }
        return implode(',',$phones);

    }
}




