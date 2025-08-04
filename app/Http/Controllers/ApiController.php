<?php
namespace App\Http\Controllers;

use App\Models\LeadModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    public function webhook(Request $request)
    {
        Log::info('Webhook hit: /v1/webhook', ['payload' => $request->all()]);

        $nzNow = Carbon::now('Pacific/Auckland');

        $data = [
            'company_id'       => 7,
            'source'           => 'fb',
            'name'             => $request->name,
            'mobile_number'    => $request->mobile_number,
            'email'            => $request->email,
            'state'            => $request->state,
            'earning_criteria' => $request->earning_criteria,
            'status'           => ($request->earning_criteria === 'b)_above_500_$') ? 'Qualified lead' : 'Enquiry',
            'license_type'     => $request->license_type ?? null,
            'income_source'    => $request->income_source ?? null,
            'required_amount'  => $request->required_amount ?? null,
            'license_version'  => $request->license_version ?? null,
            'add_by'           => 4,
            'created_at'       => $nzNow,
            'unique_id'        => $this->getlastGFCode('lead_models'),
        ];

        return LeadModel::insert($data)
        ? response()->json(['message' => 'Lead Added successfully'], 201)
        : response()->json(['message' => 'Something went wrong'], 500);
    }

    public function pannelBt(Request $request)
    {
        Log::info('Webhook hit: /v1/webhook/we-care-auto-repairs-add-pannel-bt', ['payload' => $request->all()]);
        $nzNow = Carbon::now('Pacific/Auckland');

        $data = [
            'company_id'                            => 9,
            'source'                                => 'fb',
            'name'                                  => $request->name ?? null,
            'mobile_number'                         => $request->mobile_number ?? null,
            'email'                                 => $request->email ?? null,
            'state'                                 => $request->state ?? null,
            'survey_question'                       => $request->survey_question ?? 'Insured or not insured',
            'survey_answer'                         => $request->survey_answer ?? null,
            'when_do_you_like_to_avail_the_service' => $request->when_do_you_like_to_avail_the_service ?? null,
            'car_type'                              => $request->car_type ?? null,
            'car_rego_number'                       => $request->car_rego_number ?? null,
            'license_number'                        => $request->license_number ?? null,
            'buget_tyres'                           => $request->buget_tyres ?? null,
            'tyre_size'                             => $request->tyre_size ?? null,
            'status'                                => 'Pending',
            'add_by'                                => 4,
            'created_at'                            => $nzNow,
            'unique_id'                             => $this->getlastGFCode('lead_models'),
        ];

        return LeadModel::insert($data)
        ? response()->json(['message' => 'Lead Added successfully'], 201)
        : response()->json(['message' => 'Something went wrong'], 500);
    }

    public function esteemcars(Request $request)
    {
        Log::info('Webhook hit: /v1/webhook/esteemcars', ['payload' => $request->all()]);
        $nzNow = Carbon::now('Pacific/Auckland');

        $data = [
            'company_id'                            => 8,
            'source'                                => 'fb',
            'name'                                  => $request->name ?? null,
            'mobile_number'                         => $request->mobile_number ?? null,
            'email'                                 => $request->email ?? null,
            'state'                                 => $request->state ?? null,
            'survey_question'                       => $request->survey_question ?? 'Insured or not insured',
            'survey_answer'                         => $request->survey_answer ?? null,
            'car_type'                              => $request->car_type ?? null,
            'when_do_you_like_to_avail_the_service' => $request->when_do_you_like_to_avail_the_service ?? null,
            'preferred_budget'                      => $request->preferred_budget ?? null,
            'brand_model'                           => $request->brand_model ?? null,
            'fuel_type'                             => $request->fuel_type ?? null,
            'status'                                => 'Enquiry',
            'add_by'                                => 4,
            'created_at'                            => $nzNow,
            'unique_id'                             => $this->getlastGFCode('lead_models'),
        ];

        return LeadModel::insert($data)
        ? response()->json(['message' => 'Lead Added successfully'], 201)
        : response()->json(['message' => 'Something went wrong'], 500);
    }

    public function getlastGFCode($table)
    {
        $prefix = $table === 'users' ? 'EMGF-' : 'EG-';

        $lastEntry = DB::table($table)->orderByDesc('id')->select('unique_id')->first();

        if (! empty($lastEntry) && ! empty($lastEntry->unique_id)) {
            $lastNumber = (int) str_replace($prefix, '', $lastEntry->unique_id);
            $newId      = $prefix . ($lastNumber + 1);
        } else {
            $newId = $prefix . '100';
        }

        return $newId;
    }

    public function botresponse(Request $request)
    {
        Log::info('Bot Webhook Received', ['payload' => $request->all()]);
        $data  = $request->all();
        $nzNow = Carbon::now('Pacific/Auckland');

        $watiTimestamp = isset($data['timestamp'])
        ? Carbon::createFromTimestamp($data['timestamp'])
        : $nzNow;

        $messageId = DB::table('wati_messages')->insertGetId([
            'message_id'      => $data['id'] ?? uniqid(),
            'conversation_id' => $data['conversationId'] ?? null,
            'wa_id'           => $data['waId'] ?? null,
            'text'            => $data['text'] ?? null,
            'is_bot'          => isset($data['owner']) && $data['owner'] === true,
            'operator_name'   => $data['operatorName'] ?? null,
            'event_type'      => $data['eventType'] ?? null,
            'wati_timestamp'  => $watiTimestamp,
            'created_at'      => $nzNow,
            'updated_at'      => now(),
        ]);

        $message = DB::table('wati_messages')->where('id', $messageId)->first();

        if (! $message->is_bot) {
            $matchedBot = DB::table('wati_messages')
                ->where('conversation_id', $message->conversation_id)
                ->where('is_bot', true)
                ->where('wati_timestamp', '<', $message->wati_timestamp)
                ->orderByDesc('wati_timestamp')
                ->first();

            if ($matchedBot) {
                $botText   = strtolower(trim($matchedBot->text));
                $userInput = strtolower(trim($message->text));

                if (
                    (str_contains($botText, 'earning criteria') && ! in_array($userInput, ['1', '2'])) ||
                    (str_contains($botText, 'license') && ! in_array($userInput, ['1', '2', '3', '4'])) ||
                    (str_contains($botText, 'income') && ! in_array($userInput, ['1', '2', '3', '4', '5'])) ||
                    (str_contains($botText, 'amount of loan') && ! in_array($userInput, ['1', '2', '3']))
                ) {
                    Log::warning('⛔ Invalid user input — skipping.', [
                        'question' => $botText,
                        'input'    => $userInput,
                    ]);

                    DB::table('wati_messages')->where('id', $message->id)->delete();
                    return response()->json(['message' => 'Invalid reply skipped'], 200);
                }

                DB::table('wati_messages')
                    ->where('id', $message->id)
                    ->update(['matched_bot_message_id' => $matchedBot->id]);

                Log::info('✅ Matched user reply.', [
                    'user_reply'   => $message->text,
                    'bot_question' => $matchedBot->text,
                ]);

                if (stripos($matchedBot->text, 'which city') !== false) {
                    $this->createLeadFromBot($message->conversation_id, $message->wa_id);
                }
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Received successfully'], 200);
    }

    public function createLeadFromBot($conversationId, $waId)
    {
        $nzNow = Carbon::now('Pacific/Auckland');

        // [Trim, clean, fetch answers, map them — same as your logic above...]

        // Insert into DB
        DB::table('wati_messages')->where('conversation_id', $conversationId)->delete();
    }
}
