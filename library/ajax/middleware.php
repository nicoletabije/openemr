<?php
namespace Middleware;
class MiddlewareService
{
    
    private $url = 'https://cap-middleware.onrender.com/api/';
    private $apiKey = 'e241da21-f347-4f74-820e-09868f7f0a36';

    public function insertFhirData($new, $table)
    {
        // Define the data array
        $data = array(
            'apiKey' => $this->apiKey,
            'table' => $table,
            'data' => $new
        );

        // Convert the data array to JSON
        $json_data = json_encode($data);

        // Initialize cURL session
        $ch = curl_init($this->url . "insertFhirData"); // Corrected line

        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);
    }

    private function create_encounter_resource($eid, $date, $pid) {
        /**
         * Creates an encounter resource in the specified format.
         *
         * @param string $eid      Encounter ID.
         * @param string $date     Start date of the encounter.
         * @param string $pid      Patient ID.
         *
         * @return array The encounter resource in the specified format.
         */
        $encounter_resource = [
            "id" => $eid,
            "period" => ["start" => $date],
            "subject" => [
                "type" => "Patient",
                "reference" => $pid
            ],
            "contained" => [],  // To be updated with additional information (e.g., vitals)
            "participant" => [
                "type" => "doctor",
                "actor" => $_SESSION['pc_username']
            ],
            "resource_type" => "Encounter",
            "api_key" => $this->apiKey
        ];
    
        return $encounter_resource;
    }

    public function insertEncounterData($new, $table)
    {
        $encounter_resource = $this->create_encounter_resource($new['encounter'], $new['date'], $new['pid']);

        // Define the data array
        $data = array(
            'apiKey' => $this->apiKey,
            'table' => $table,
            'data' => $encounter_resource,
            'raw' => $new
        );

        // Convert the data array to JSON
        $json_data = json_encode($data);

        // Initialize cURL session
        $ch = curl_init($this->url . "insertEncounterData"); // Corrected line

        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);
    }

    public function insertVitalsData($new, $table)
    {
        // $encounter_resource = $this->create_encounter_resource($new['encounter'], $new['date'], $new['pid']);

        // Define the data array
        $data = array(
            'apiKey' => $this->apiKey,
            'table' => $table,
            'data' => $new,
            "actor" => $_SESSION['pc_username']
        );

        // Convert the data array to JSON
        $json_data = json_encode($data);

        // Initialize cURL session
        $ch = curl_init($this->url . "addVitals"); // Corrected line

        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);
    }

    public function insertROS($new)
    {
        // $encounter_resource = $this->create_encounter_resource($new['encounter'], $new['date'], $new['pid']);

        // Define the data array
        $data = array(
            'apiKey' => $this->apiKey,
            'data' => $new,
            "actor" => $_SESSION['pc_username']
        );

        // Convert the data array to JSON
        $json_data = json_encode($data);

        // Initialize cURL session
        $ch = curl_init($this->url . "addROS"); // Corrected line

        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);
    }

    public function insertSignsAndSymptoms($new, $eid)
    {
        // $encounter_resource = $this->create_encounter_resource($new['encounter'], $new['date'], $new['pid']);

        // Define the data array
        $data = [
            'new' => $new,
            'eid' => $eid,
            'apiKey' => $this->apiKey,
            "actor" => $_SESSION['pc_username']
        ];

        // Convert the data array to JSON
        $json_data = json_encode($data);

        // Initialize cURL session
        $ch = curl_init($this->url . "consoleData"); // Corrected line or route from cap-middleware

        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);
    }

    public function insertCareplan($new, $eid)
    {
        // $encounter_resource = $this->create_encounter_resource($new['encounter'], $new['date'], $new['pid']);

        // Define the data array
        $data = [
            'new' => $new,
            'eid' => $eid,
            'apiKey' => $this->apiKey,
            "actor" => $_SESSION['pc_username']
        ];

        // Convert the data array to JSON
        $json_data = json_encode($data);

        // Initialize cURL session
        $ch = curl_init($this->url . "addCarePlan"); // Corrected line

        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);
    }

    public function insertIssues($post, $issueRecord)
    {
        // $encounter_resource = $this->create_encounter_resource($new['encounter'], $new['date'], $new['pid']);

        // Define the data array
        $data = [
            // 'sesh' => $sesh, 
            'pid' => $_SESSION['pid'],
            'eid' => $_SESSION['encounter'],
            'post' => json_encode($post), 
            'issueRecord' => json_encode($issueRecord),
            'apiKey' => $this->apiKey,
            'actor' => $_SESSION['pc_username']
        ];

        // Convert the data array to JSON
        $json_data = json_encode($data);

        // Initialize cURL session
        $ch = curl_init($this->url . "addFinalDiagnosis"); // Corrected line

        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Close cURL session
        curl_close($ch);
    }


}
?>
