<?php
/**
 * Created by PhpStorm.
 * User: sureshkumar
 * Date: 10/08/2016
 * Time: 10:52 AM
 */


namespace BusinessLogic;
use Helper;
use  BusinessObject\User;
use  BusinessObject\Language;
use Validator;
use DB;

class LanguageServiceProvider
{
    public function updateUserLanguages($userId, $requestData)
    {
        // Delete languages
        if(!isset($requestData['user_language']))
            $requestData['user_language'] = array();
        $this->deleteLangauges($userId, $requestData['user_language'], $this->getUserLanguages($userId));

        if(!empty($requestData['user_language']))
        {
            foreach ($requestData['user_language'] as $key => $language) 
            {
                $proficiency = $requestData['language_proficiency'][$key];
                $languageData = $this->languageExists($userId, $language);


                if(!empty($languageData))
                {
                    if($languageData->proficiency = $proficiency)
                    {
                        $this->update($languageData->id, $language, $proficiency);
                    }
                }
                else
                {
                    $this->save($userId, $language, $proficiency);
                }
            }            
        }


        return ['code' => 200, 'status' => 'ok', 'msg' => 'Language updated successfully'];
    }

    public function deleteLangauges($userId, $userLanguages, $dbLanguages)
    {
        if(!empty($dbLanguages['data']))
        {
            foreach ($dbLanguages['data'] as $key => $dbLanguage) 
            {
                if(!in_array($dbLanguage['language'], $userLanguages))
                {
                    $this->deleteLanguage($userId, $dbLanguage['language']);
                }
            }
        }
    }

    public function deleteLanguage($userId, $language)
    {
        $rec = Language::where('user_id', $userId)->where('language', $language)->delete();
    }

    public function languageExists($userId, $language)
    {
        return Language::where('user_id', $userId)->where('language', $language)->first();
    }

    public function save($userId, $language, $proficiency)
    {
        $rec = new Language();
        $rec->user_id = $userId;
        $rec->language = $language;
        $rec->proficiency = $proficiency;
        return $rec->save();
    }

    public function getUserLanguages($userId)
    {
        $data = array();
        $userLanguages = Language::where('user_id', $userId)->get()->toArray();
        foreach ($userLanguages as $key => $userLanguage) 
        {
            $data[] = $userLanguage;

        }
        return array('status' =>'ok', 'data' => $data, 'code' => 200);
    }

    public function update($languageId, $language, $proficiency)
    {
        $rec = Language::find($languageId);
        $rec->language = $language;
        $rec->proficiency = $proficiency;
        $rec->update();
    }


}
