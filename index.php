<?php

  // 1.a

  function getRoomStats($data)
  {
      $roomStats = [];

      
      foreach ($data as $entry) {
          $roomName = $entry['namaruangan'];
          if (isset($roomStats[$roomName])) {
              $roomStats[$roomName]['jumlahpasien']++;
          } else {
              $roomStats[$roomName] = [
                  'namaruangan' => $roomName,
                  'jumlahpasien' => 1,
              ];
          }
      }
      return array_values($roomStats);
  }

  // Menerima data JSON melalui metode POST
  $jsonData = file_get_contents('php://input');
  $array1 = json_decode($jsonData, true);
  
  if (!is_array($array1)) {
      http_response_code(400);
      echo json_encode(['error' => 'Invalid input data. Please provide a valid JSON array.']);
      exit;
  }

  header('Content-Type: application/json');
  echo json_encode(getRoomStats($array1));

  // 1.b
  function getDoctorStats($data)
    {
        $doctorStats = [];
        foreach ($data as $entry) {
            $doctorName = $entry['namadokter'];
            if (isset($doctorStats[$doctorName])) {
                $doctorStats[$doctorName]['jumlahpasien']++;
            } else {
                $doctorStats[$doctorName] = [
                    'namadokter' => $doctorName,
                    'jumlahpasien' => 1,
                ];
            }
        }
        return array_values($doctorStats);
    }

    // Menerima data JSON melalui metode POST
    $jsonData = file_get_contents('php://input');
    $array1 = json_decode($jsonData, true);

    // Jika data tidak valid, kembalikan pesan kesalahan
    if (!is_array($array1)) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input data. Please provide a valid JSON array.']);
        exit;
    }

    header('Content-Type: application/json');
    echo json_encode(getDoctorStats($array1));

  

  // 2
  function countLetterInName($data, $letter)
  {
      $count = 0;
      foreach ($data as $entry) {
          $name = strtoupper($entry['namapasien']); // Ubah nama pasien menjadi huruf kapital
          $count += substr_count($name, strtoupper($letter));
      }
      return $count;
  }

  // Menerima data JSON melalui metode POST
  $jsonData = file_get_contents('php://input');
  $array1 = json_decode($jsonData, true);

  // Jika data tidak valid, kembalikan pesan kesalahan
  if (!is_array($array1)) {
      http_response_code(400);
      echo json_encode(['error' => 'Invalid input data. Please provide a valid JSON array.']);
      exit;
  }

  // Menerima huruf yang ingin dihitung melalui query parameter
  $letter = isset($_GET['letter']) ? $_GET['letter'] : '';

  // Jika huruf tidak valid, kembalikan pesan kesalahan
  if (strlen($letter) != 1 || !ctype_alpha($letter)) {
      http_response_code(400);
      echo json_encode(['error' => 'Invalid letter. Please provide a single alphabetical character.']);
      exit;`
  }

  header('Content-Type: application/json');
  echo json_encode([
      'letter' => strtoupper($letter),
      'count' => countLetterInName($array1, $letter),
  ]);



  // 3
  function getPatientData($data) {
      $response = array_map(function ($item) {
          return [
              'namapasien' => $item['namapasien'],
              'tglregistrasi' => $item['tglregistrasi']
          ];
      }, $data);

      return $response;
  }

  // Menerima data JSON melalui metode POST
    $jsonData = file_get_contents('php://input');
    $array1 = json_decode($jsonData, true);

    // Jika data tidak valid, kembalikan pesan kesalahan
    if (!is_array($array1)) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input data. Please provide a valid JSON array.']);
        exit;
    }

    header('Content-Type: application/json');
    echo json_encode(getPatientData($array1));



// 4
function addNumbering($data)
{
    $numberedData = [];
    $i = 1;
    foreach ($data as $entry) {
        $entry['nomor'] = $i++;
        $numberedData[] = $entry;
    }
    return $numberedData;
}

// Menerima data JSON melalui metode POST
$jsonData = file_get_contents('php://input');
$array1 = json_decode($jsonData, true);

// Jika data tidak valid, kembalikan pesan kesalahan
if (!is_array($array1)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid input data. Please provide a valid JSON array.']);
    exit;
}

header('Content-Type: application/json');
echo json_encode(addNumbering($array1));

?>






  