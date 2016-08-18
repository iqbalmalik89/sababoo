<?php
namespace App\Validator;

class Validate{

    public static  function validateMe($post_data,$validate_array = null){
        $messages = [
            'username.required'     => trans('messages.username_required'),
            'password.required'     => trans('messages.password_required'),
            'password.min'          => trans('messages.password_min'),
            'username.email'        => trans('messages.username_email'),

            'first_name.required'    => trans('messages.first_name_required'),
            'last_name.required'     => trans('messages.last_name_required'),

            'email.required'        => trans('messages.email_required'),
            'email.email'           => trans('messages.email_email'),

            'firstname.regex'       => trans('messages.firstname_regex'),
            'lastname.regex'        => trans('messages.lastname_regex'),

            'password2.required'    => trans('messages.password2_required'),
            'password1.required'    => trans('messages.password1_required'),
            'password1.min'         => trans('messages.password_new_min'),
            'password2.min'         => trans('messages.password2_min'),
            'password_new.required'    => trans('messages.password_new_required'),
            'password_new.min'      => trans('messages.password_new_min'),

            'password_confirm.required'    => trans('messages.password_confirm_required'),

            'telephone.required'    => trans('messages.telephone_required'),
            'telephone.regex'       => trans('messages.telephone_regex'),
            'telephone.numeric'     => trans('messages.telephone_number'),

            'address1.required'     => trans('messages.address1_required'),
            'city.required'         => trans('messages.city_required'),
            'state.required'        => trans('messages.state_required'),

            'zipcode.required'      => trans('messages.zipcode_required'),
            'zipcode.numeric'        => trans('messages.zipcode_number'),

            'country.required'      => trans('messages.country_required'),
            'captcha.required'      => trans('messages.captcha_required'),
            'agree.required'        => trans('messages.agree_required'),

            'account_daily_budget.numeric'  =>trans('messages.account_daily_budget_numeric'),
            'account_daily_budget.min'      =>trans('messages.account_daily_budget_min'),


            'refill_sod_amount.numeric'         => trans('messages.refill_sod_amount_numeric'),
            'refill_sod_amount.min'             => trans('messages.refill_sod_amount_min'),

            'refill_fixed_amount.numeric'       => trans('messages.refill_fixed_amount_numeric'),
            'refill_fixed_amount.min'           => trans('messages.refill_fixed_amount_min'),

            'refill_con_charged_amount.numeric' => trans('messages.refill_con_charged_amount_numeric'),
            'refill_con_charged_amount.min'     => trans('messages.refill_con_charged_amount_min'),

            'refill_con_min_amount.numeric'     => trans('messages.refill_con_min_amount_numeric'),
            'refill_con_min_amount.min'         => trans('messages.refill_con_min_amount_min'),
            'msg.required'                  => trans('messages.msg_required'),
            'topic.required'                => trans('messages.topic_required'),
            'school_name.required'          => trans('messages.school_name_required'),
            'degree.required'               => trans('messages.degree_required'),
            'field_study.required'          => trans('messages.field_study_required'),
            'job_position.required'          => trans('messages.job_position_required'),
            'company_name.required'          => trans('messages.company_name_required'),
            'date_from_month.required'       => trans('messages.date_from_month_required'),
            'date_from_year.required'        => trans('messages.date_from_year_required'),


        ];

        $validator = \Validator::make($post_data, $validate_array, $messages);

        if ($validator->fails()) {
            //$err = "<ul>";
            $err = "";
            foreach ($validator->getMessageBag()->toArray() as $error) {
                foreach ($error as $msg) {
                    $err .= "$msg|";
                }
            }
            //$err .= "";
            return array(
                'code' => 401,
                'status' => 'error',
                'msg' => $err
            );
        } else {
            return array(
                'code' => 200,
                'status' => 'ok',
            );
        }
    }
}



?>