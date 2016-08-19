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
use  BusinessObject\UserSkill;
use  BusinessObject\Skill;
use Validator;
use DB;

class SkillServiceProvider
{
    public function updateUserSkills($userId, $userSkills)
    {
        // Delete user skills
        $this->deleteUserSkills($userId, $userSkills);

        foreach (explode(',', $userSkills) as $key => $skillId) {

            $skillId = trim($skillId);

            if(!$this->skillExists($userId, $skillId))
            {
                $this->saveUserSkill($userId, $skillId);
            }
        }

        return ['code' => 200, 'status' => 'ok', 'message' => 'Skills updated successfully'];
    }

    public function deleteUserSkills($userId, $userSkills)
    {
        $userSkillsDb = $this->getUserSkills($userId);
        if(!empty($userSkillsDb))
        {
            foreach ($userSkillsDb as $key => $userSkillDb) {
                if(!in_array($userSkillDb['value'], explode(',', $userSkills)))
                {
                    UserSkill::where('skill_id', $userSkillDb['value'])->where('user_id', $userId)->delete();
                }
            }
        }
    }
    

    public function skillExists($userId, $skillId)
    {
        return UserSkill::where('user_id', $userId)->where('skill_id', $skillId)->count();
    }

    public function save($skillArr)
    {

    }

    public function getUserSkills($userId)
    {
        $data = array();
        $userSkills = UserSkill::where('user_id', $userId)->get();
        foreach ($userSkills as $key => $userSkill) 
        {
            $skillData = $this->getSkill($userSkill->skill_id);
            $data[] = array('value' => $skillData['id'], 'label' => $skillData['skill']);
        }
        return $data;
    }

    public function getSkill($id)
    {
        $rec = Skill::find($id);
        if(!empty($rec))
            $rec = $rec->toArray();
        return $rec;
    }

    public function update($skill, $skillObj)
    {

    }

    function saveUserSkill($userId, $skillId)
    {
        $rec = new UserSkill();
        $rec->user_id = $userId;
        $rec->skill_id = $skillId;
        return $rec->save();
    }


    public function get($page, $limit)
    {
        if($limit)
        {

        }
        else
        {
            $skills = Skill::get();
        }

        return array('code'=>200,'status'=>'ok', 'data' =>$skills,'msg'=>'Recored fetched successfully.');        
    }



}
