<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "setting".
 *
 * @property int $id_exercise annee à laquelle correspond ces paramètres
 * @property double $registration_fees montant des frais d'inscription
 * @property double $interest_rate valeur du taux d'interêt pour les emprunts.Exemple : 0.1 pour 10%
 * @property double $amount_sb_om montant du fond social pour les anciens membres (membres s'ayant inscrit avant l'année à laquelle ces paramètres s'appliquent)
 * @property double $amount_sb_nm montant du fond social pour les nouveaux membres (membres s'ayant inscrit lors de l'année à laquelle ces paramètres s'appliquent)
 * @property int $delays_sb nombre de mois octroyés aux membres pour payer le fondsocial de l'exercice correspondant à cette année.Pour les anciens membre : on commence à compter les mois restant à partir de la date de début de l'exercicePour les nouveaux membre : on commence à compter les mois restant à partir de leur date d'inscription
 * @property double $parent_death montant à verser en cas de déces du parent d'un membre
 * @property double $parent_in_law_death montant à verser en cas de déces du beau parent d'un membre
 * @property double $member_death montant à verser à la famille en cas de déces d'un  membre
 * @property double $partner_death montant à verser en cas de déces du conjoint d'un membre
 * @property double $childreen_death montant à verser en cas de déces de l'enfant d'un membre
 * @property double $birth montant à verser en cas de naissance d'un enfant d'un membre
 * @property double $wedding montant à verser en cas de mariage d'un membre
 * @property double $other_happy_events montant à verser en cas d'autres evenement joyeux
 * @property double $other_unfortunate_events montant à verser en cas d'autres evenement malheureux
 *
 * @property Exercise $exercise
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_exercise', 'registration_fees', 'interest_rate', 'amount_sb_om', 'amount_sb_nm', 'parent_death', 'parent_in_law_death', 'member_death', 'partner_death', 'childreen_death', 'birth', 'wedding', 'other_happy_events', 'other_unfortunate_events'], 'required'],
            [['id_exercise', 'delays_sb'], 'integer'],
            [['registration_fees', 'interest_rate', 'amount_sb_om', 'amount_sb_nm', 'parent_death', 'parent_in_law_death', 'member_death', 'partner_death', 'childreen_death', 'birth', 'wedding', 'other_happy_events', 'other_unfortunate_events'], 'number'],
            [['id_exercise'], 'unique'],
            [['id_exercise'], 'exist', 'skipOnError' => true, 'targetClass' => Exercise::className(), 'targetAttribute' => ['id_exercise' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_exercise' => 'Id Exercise',
            'registration_fees' => 'Registration Fees',
            'interest_rate' => 'Interest Rate',
            'amount_sb_om' => 'Amount Sb Om',
            'amount_sb_nm' => 'Amount Sb Nm',
            'delays_sb' => 'Delays Sb',
            'parent_death' => 'Parent Death',
            'parent_in_law_death' => 'Parent In Law Death',
            'member_death' => 'Member Death',
            'partner_death' => 'Partner Death',
            'childreen_death' => 'Childreen Death',
            'birth' => 'Birth',
            'wedding' => 'Wedding',
            'other_happy_events' => 'Other Happy Events',
            'other_unfortunate_events' => 'Other Unfortunate Events',
        ];
    }

    public function getDefaultSetting(){
        $this->interest_rate = 0.01;
        $this->registration_fees = 50000;
        $this->amount_sb_om = 20000;
        $this->amount_sb_nm = 30000;
        $this->delays_sb = 6;
        $this->parent_death = 200000;
        $this->parent_in_law_death = 200000;
        $this->member_death = 100000;
        $this->partner_death = 100000;
        $this->childreen_death = 50000;
        $this->wedding = 50000;
        $this->birth = 50000;
        $this->other_happy_events = 25000;
        $this->other_unfortunate_events = 50000;
        return $this;
    }
    
    public function clonage($setting, $id){
        $this->id_exercise = $id;
        $this->interest_rate = $setting->interest_rate;
        $this->registration_fees = $setting->registration_fees;
        $this->amount_sb_om = $setting->amount_sb_om;
        $this->amount_sb_nm = $setting->amount_sb_nm;
        $this->delays_sb = $setting->delays_sb;
        $this->parent_death = $setting->parent_death;
        $this->parent_in_law_death = $setting->parent_in_law_death;
        $this->member_death = $setting->member_death;
        $this->partner_death = $setting->partner_death;
        $this->childreen_death = $setting->childreen_death;
        $this->wedding = $setting->wedding;
        $this->birth = $setting->birth;
        $this->other_happy_events = $setting->other_happy_events;
        $this->other_unfortunate_events = $setting->other_unfortunate_events;
        return $this;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExercise()
    {
        return $this->hasOne(Exercise::className(), ['id' => 'id_exercise']);
    }
}
