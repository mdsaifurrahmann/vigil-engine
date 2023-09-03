<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneratorModel;
use App\Models\Logger;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class GeneratorController extends Controller
{
    public function sendResponse(Request $request, GeneratorModel $generator)
    {
        $communication_key = $request->input('wireclue');
        $domainName = $request->input('wirezone');

        $key = $generator::where('wirezone', $domainName)->firstOrFail();

        if ($key->communication_key == $communication_key && $key->wirezone == $domainName && $key->status == 1) {
            return response()->json(['status' => 'valid']);
        } else {
            $getLogs = Logger::where('wirezone', $domainName)->where('communication_key', $communication_key)->first();

            if ($getLogs) {
                Logger::where('wirezone', $domainName)->where('communication_key', $communication_key)->update([
                    'count' => $getLogs->count + 1,
                ]);
            } else {
                $count = +1;
                Logger::create([
                    'wirezone' => $domainName,
                    'communication_key' => $communication_key,
                    'count' => $count
                ]);
            }
            return response()->json(['status' => 'indispose']);
        }
    }


    public function getResponse(Request $request, Logger $logger)
    {
        $app_name = $request->input('app');
        $interface = $request->input('interface');
        $domainName = $request->input('host');
        $hostip = $request->input('hostip');
        $conf = $request->input('conf');
        $expose = $request->input('expose_time');
        $modifiedFiles = '';

        $log = $logger::where('wirezone', $domainName)->where('communication_key', $interface)->first();

        // 

        if (($log->count === 1) || ($log->count === 3) || ($log->count === 7) || ($log->count === 13)) {
            Mail::send('email.solidity', ['app_name' => $app_name, 'interface' => $interface, 'modifiedFiles' => $modifiedFiles, 'domainName' => $domainName, 'hostip' => $hostip, 'conf' => $conf, 'expose' => $expose], function ($message) use ($app_name) {
                $message->to('integrity@codebumble.net')
                    ->subject('Indispose Detected on app ' . $app_name);
            });
        }

        return $request->next;
    }

    public function ghostResponse(Request $request, Logger $logger)
    {
        $app_name = $request->input('app_name');
        $interface = $request->input('interface');
        $domainName = $request->input('host');
        $hostip = $request->input('hostip');
        $conf = $request->input('conf');
        $expose = $request->input('expose_time');
        $modifiedFiles = '';

        $log = $logger::where('wirezone', $domainName)->where('communication_key', $interface)->first();

        if (!$log) {
            $logger::create([
                'wirezone' => $domainName,
                'communication_key' => $interface,
                'count' => 1,
                'app_name' => $app_name,
            ]);

            Mail::send('email.solidity', ['app_name' => $app_name, 'interface' => $interface, 'modifiedFiles' => $modifiedFiles, 'domainName' => $domainName, 'hostip' => $hostip, 'conf' => $conf, 'expose' => $expose], function ($message) use ($app_name) {
                $message->to('integrity@codebumble.net')
                    ->subject('Ghost Detected on app ' . $app_name);
            });
        } else {
            $logger::where('wirezone', $domainName)->where('communication_key', $interface)->update([
                'count' => $log->count + 1,
            ]);
            if ($log->count == 2 || $log->count == 6 || $log->count == 12) {
                Mail::send('email.solidity', ['app_name' => $app_name, 'interface' => $interface, 'modifiedFiles' => $modifiedFiles, 'domainName' => $domainName, 'hostip' => $hostip, 'conf' => $conf, 'expose' => $expose], function ($message) use ($app_name) {
                    $message->to('integrity@codebumble.net')
                        ->subject('Ghost Detected on app ' . $app_name);
                });
            }
        }
        return $request->next;
    }

    public function integrityResponse(Request $request)
    {
        $app_name = $request->input('app_name');
        $interface = $request->input('interface');
        $domainName = $request->input('host');
        $hostip = $request->input('hostip');
        $conf = $request->input('conf');
        $expose = $request->input('expose_time');
        $modifiedFiles = $request->input('modifiedFiles');

        Mail::send('email.solidity', ['app_name' => $app_name, 'interface' => $interface, 'modifiedFiles' => $modifiedFiles, 'domainName' => $domainName, 'hostip' => $hostip, 'conf' => $conf, 'expose' => $expose], function ($message) use ($app_name) {
            $message->to('integrity@codebumble.net')
                ->subject($app_name . ' - System Integrity Report');
        });

        return $request->next;
    }
}
