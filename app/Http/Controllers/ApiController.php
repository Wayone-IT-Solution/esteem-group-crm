<?php

namespace App\Http\Controllers;

use App\Models\LeadModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

class ApiController extends Controller
{
    public function webhook(Request $request)
    {
        $data = [
            'company_id' => 7,
            'source' => 'fb',
            'name' => $request->name,
            'mobile_number' => $request->mobile,
            'email' =>  $request->email,
            'state' => $request->state,
            'earning_criteria' => $request->earning_criteria,
            'status' => ($request->earning_criteria === 'b)_above_500_$') ? 'Qualified lead' : 'Enquiry',
            'license_type' => $request->license_type ?? null,
            'income_source' => $request->income_source ?? null,
            'required_amount' => $request->required_amount ?? null,
            'license_version' => $request->license_version ?? null,
            'add_by' => 4,
            'created_at' => now(),
            'unique_id' => $this->getlastGFCode('lead_models'),
        ];

        $query =    LeadModel::insert($data);
        if ($query) {
            return response()->json(['message' => 'Lead Added successfully'], 201);
        } else {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }


    // for we care auto repairs
    public function pannelBt(Request $request)
    {
        $data = [
            'company_id' => 9,
            'source' => 'fb',
            'name' => $request->name ?? null,
            'mobile_number' => $request->mobile_number ?? null,
            'email' => $request->email ?? null,
            'state' => $request->state ?? null,
            'survey_question' => $request->survey_question ?? 'Insured or not insured',
            'survey_answer' => $request->survey_answer ?? null,
            'when_do_you_like_to_avail_the_service' => $request->when_do_you_like_to_avail_the_service ?? null,
            'car_type' => $request->car_type ?? null,
            'car_rego_number' => $request->car_rego_number ?? null,
            'license_number' => $request->license_number ?? null,
            'buget_tyres' => $request->buget_tyres ?? null,
            'tyre_size' => $request->tyre_size ?? null,
            'status' => 'Pending',
            'add_by' => 4,
            'created_at' => now(),
            'unique_id' => $this->getlastGFCode('lead_models'),
        ];


        $query =    LeadModel::insert($data);
        if ($query) {
            return response()->json(['message' => 'Lead Added successfully'], 201);
        } else {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

    public function getlastGFCode($table)
    {
        $prefix = 'EG-';
        if ($table === 'users') {
            $prefix = 'EMGF-';
        }

        $lastEntry = DB::table($table)
            ->orderByDesc('id')
            ->select('unique_id')
            ->first();

        if (!empty($lastEntry) && !empty($lastEntry->unique_id)) {
            $lastNumber = (int) str_replace($prefix, '', $lastEntry->unique_id);
            $newId = $prefix . ($lastNumber + 1);
        } else {
            $newId = $prefix . '100';
        }

        return $newId;
    }




    public function botresponse(Request $request)
    {
        $data = $request->all();

        $watiTimestamp = isset($data['timestamp']) ? Carbon::createFromTimestamp($data['timestamp']) : now();

        $messageId = DB::table('wati_messages')->insertGetId([
            'message_id'      => $data['id'] ?? uniqid(),
            'conversation_id' => $data['conversationId'] ?? null,
            'wa_id'           => $data['waId'] ?? null,
            'text'            => $data['text'] ?? null,
            'is_bot'          => isset($data['owner']) && $data['owner'] === true,
            'operator_name'   => $data['operatorName'] ?? null,
            'event_type'      => $data['eventType'] ?? null,
            'wati_timestamp'  => $watiTimestamp,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        $message = DB::table('wati_messages')->where('id', $messageId)->first();

        if (!$message->is_bot) {
            $matchedBot = DB::table('wati_messages')
                ->where('conversation_id', $message->conversation_id)
                ->where('is_bot', true)
                ->where('wati_timestamp', '<', $message->wati_timestamp)
                ->orderByDesc('wati_timestamp')
                ->first();

            if ($matchedBot) {
                $botText = strtolower(trim($matchedBot->text));
                $userInput = strtolower(trim($message->text));

                if (
                    (str_contains($botText, 'earning criteria') && !in_array($userInput, ['1', '2'])) ||
                    (str_contains($botText, 'license') && !in_array($userInput, ['1', '2', '3', '4'])) ||
                    (str_contains($botText, 'income') && !in_array($userInput, ['1', '2', '3', '4', '5'])) ||
                    (str_contains($botText, 'amount of loan') && !in_array($userInput, ['1', '2', '3']))
                ) {
                    Log::warning('⛔ Invalid user input — skipping.', [
                        'question' => $botText,
                        'input' => $userInput,
                    ]);

                    DB::table('wati_messages')->where('id', $message->id)->delete();
                    return response()->json(['message' => 'Invalid reply skipped'], 200);
                }

                DB::table('wati_messages')
                    ->where('id', $message->id)
                    ->update(['matched_bot_message_id' => $matchedBot->id]);

                Log::info('✅ Matched user reply.', [
                    'user_reply' => $message->text,
                    'bot_question' => $matchedBot->text
                ]);

                if (stripos($matchedBot->text, 'which city') !== false) {
                    $this->createLeadFromBot($message->conversation_id, $message->wa_id);
                }
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Received successfully'], 200);
    }




    public function createLeadFromBot()
    {
        $conversationId = '67efb506e51882980b5c118d';
        $waId = '918595529873';
        $botQuestions = [
            'criteria',
            'type of license',
            'Driving License',
            'Driving Version',
            'income',
            'amount of loan',
            'full name',
            'email',
            'which city'
        ];

        $userAnswers = [];

        $messages = DB::table('wati_messages')->where('conversation_id', $conversationId)->where('is_bot', 1)->get();

        foreach ($messages as $message) {
            $cleaned = strtolower($message->text);
            $cleaned = preg_replace('/\x{A0}+/u', ' ', $cleaned); // remove \u{A0}
            $cleaned = preg_replace('/\s+/', ' ', $cleaned);      // collapse spaces/newlines
            $cleaned = str_replace('*', '', $cleaned);            // remove *
            $cleaned = trim($cleaned);

            DB::table('wati_messages')
                ->where('id', $message->id)
                ->update(['text' => $cleaned]);
        }





        $answer = DB::table('wati_messages')
            ->where('conversation_id', $conversationId)
            ->where('is_bot', false)
            ->whereIn('matched_bot_message_id', function ($q) use ($conversationId) {
                $q->select('id')
                    ->from('wati_messages')
                    ->where('conversation_id', $conversationId)
                    ->where('is_bot', true)
                    ->where('text', 'like', '%earning criteria%');
            })
            ->orderBy('wati_timestamp')
            ->value('text');

        dd($answer); // Output directly to test




        foreach ($botQuestions as $question) {
            return $answer = DB::table('wati_messages')
                ->where('conversation_id', $conversationId)
                ->where('is_bot', false)
                ->whereIn('matched_bot_message_id', function ($q) use ($conversationId, $question) {
                    $q->select('id')
                        ->from('wati_messages')
                        ->where('conversation_id', $conversationId)
                        ->where('is_bot', true)
                        ->whereRaw("LOWER(text) LIKE ?", ['%earning criteria%']);
                })
                ->orderBy('wati_timestamp')
                ->value('text');

            Log::debug("📌 Answer for '$question': " . ($answer ?? 'null'));
            $userAnswers[] = $answer;
        }

        // Assign with fallback
        $earning_criteria   = $userAnswers[0] ?? null;
        $license_type       = $userAnswers[1] ?? null;
        $license_number     = $userAnswers[2] ?? null;
        $license_version    = $userAnswers[3] ?? null;
        $income_source      = $userAnswers[4] ?? null;
        $required_amount    = $userAnswers[5] ?? null;
        $name               = $userAnswers[6] ?? 'WhatsApp User';
        $email              = $userAnswers[7] ?? null;
        $city               = $userAnswers[8] ?? null;

        // Map values
        $earning_criteria_text = match (trim($earning_criteria)) {
            '1' => 'a)_less_than_500_$',
            '2' => 'b)_above_500_$',
            default => $earning_criteria
        };

        $license_type_text = match (trim($license_type)) {
            '1' => 'Learning License',
            '2' => 'Restricted License',
            '3' => 'Full Time License',
            '4' => 'International License',
            default => $license_type
        };

        $income_source_text = match (trim($income_source)) {
            '1' => 'Full Time Employed',
            '2' => 'Part Time Employed',
            '3' => 'Self-Employed',
            '4' => 'Part Time & Benefit',
            '5' => 'Benefit Only',
            default => $income_source
        };

        $required_amount_text = match (trim($required_amount)) {
            '1' => '5K - 15K',
            '2' => '15K - 30K',
            '3' => '30K - Above',
            default => $required_amount
        };

        return $earning_criteria_text;

        // Insert lead
        $leadData = [
            'company_id'       => 7,
            'source'           => 'whatsapp',
            'name'             => (!is_numeric($name)) ? $name : 'WhatsApp User',
            'mobile_number'    => $waId,
            'email'            => (filter_var($email, FILTER_VALIDATE_EMAIL)) ? $email : null,
            'state'            => $city,
            'earning_criteria' => $earning_criteria_text,
            'status'           => ($earning_criteria_text === 'b)_above_500_$') ? 'Qualified lead' : 'Enquiry',
            'license_type'     => $license_type_text,
            'license_number'   => $license_number,
            'license_version'  => $license_version,
            'income_source'    => $income_source_text,
            'required_amount'  => $required_amount_text,
            'add_by'           => 4,
            'created_at'       => now(),
            'unique_id'        => $this->getlastGFCode('lead_models'),
        ];

        LeadModel::insert($leadData);
        // Log::info('✅ Lead created:', $leadData);

        DB::table('wati_messages')->where('conversation_id', $conversationId)->delete();
        // Log::info("🗑️ Cleaned up conversation: {$conversationId}");
    }
}
