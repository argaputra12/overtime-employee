<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Surat Perintah Lembur</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    td,
    th {
      text-transform: capitalize;
    }

    .container {
      width: 600px;
      margin: 0 auto;
    }

    .header {
      text-align: center;
      font-weight: bold;
      margin-bottom: 20px;
      border: 1px solid black;
      padding: 20px;
    }

    .content {
      border: 1px solid black;
      padding: 20px;
    }

    .starter{
        margin-bottom: 20px;
        text-align: justify;
    }

    .signature-section {
      display: flex;
      gap: 10px;
      justify-content: space-between;
      margin-top: 40px;
      text-transform: capitalize;
    }

    .signature-block {
      text-align: center;
      width: 40%;
      border: 1px solid black;
      padding: 2px;
      display: flex;
    }

    .signature-block div {
      margin-top: 60px;
    }

    .info-table {
      width: 100%;
      margin-bottom: 20px;
      border-collapse: collapse;
    }

    .info-table td {
      padding: 5px;
    }

    .info-table td:first-child {
      width: 150px;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="header">
      SURAT PERINTAH LEMBUR
    </div>

    <div class="content">
            <p class="starter">
            Pada hari ini, {{ $today }} dengan ini memberikan perintah lembur kepada:
        </p>

      <table class="info-table">
        <tr>
          <td>Nama</td>
          <td>: {{ $overtime_approval->overtime_request->employee->user->name }}</td>
        </tr>
        <tr>
          <td>Posisi</td>
          <td>: Junior Piping Engineer</td>
        </tr>
        <tr>
          <td>Tanggal</td>
          <td>: {{ $overtime_approval->overtime_request->date }}</td>
        </tr>
        <tr>
          <td>Jam Mulai</td>
          <td>: {{ $overtime_approval->overtime_request->start_time }}</td>
        </tr>
        <tr>
          <td>Jam Selesai</td>
          <td>: {{ $overtime_approval->overtime_request->end_time }}</td>
        </tr>
        <tr>
          <td>Durasi (Jam)</td>
          <td>: {{ $overtime_approval->overtime_request->duration }} Jam</td>
        </tr>
        <tr>
          <td>Pekerjaan</td>
          <td>: {{ $overtime_approval->overtime_request->reason }}</td>
        </tr>
      </table>

      {{-- Signature Column --}}

      <table style="width: 70%; text-align: center; border-collapse: collapse;">
        <tr>
          <td style="border: 1px solid black; width: 50%;">
            Penerima Tugas
          </td>
          <td style="border: 1px solid black;">
            Manager
          </td>
        </tr>
        <tr>
          <td style="height: 60px; border: 1px solid black;">
            <!-- Space for signature -->
            <img src="{{ $employee_signature }}" alt="" style="height: 60px; width: 100px">
          </td>
          <td style="height: 60px; border: 1px solid black;">
            <!-- Space for signature -->
            <img src="{{ $manager_signature }}" alt="" style="height: 60px; width: 100px">
          </td>
        </tr>
        <tr>
          <td style="border: 1px solid black;">
            {{ $overtime_approval->overtime_request->employee->user->name }}
          </td>
          <td style="border: 1px solid black;">
            {{ $overtime_approval->manager->user->name }}
          </td>
        </tr>
      </table>
    </div>
  </div>

</body>

</html>
