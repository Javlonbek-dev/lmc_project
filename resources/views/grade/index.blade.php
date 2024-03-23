<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Student ID</th>
        <th>Assignment ID</th>
        <th>Assignment Title</th>
        <th>Assignment Description</th>
        <th>Grade Value</th>
        <th>Graded At</th>
        <th>Created At</th>
        <th>Updated At</th>
    </tr>
    </thead>
    <tbody>
    @foreach($grades as $grade)
        <tr>
            <td>{{ $grade['id'] }}</td>
            <td>{{ $grade['student_id'] }}</td>
            <td>{{ $grade['assignment']['id'] }}</td>
            <td>{{ $grade['assignment']['title'] }}</td>
            <td>{{ $grade['assignment']['description'] }}</td>
            <td>{{ $grade['grade_value'] }}</td>
            <td>{{ $grade['graded_at'] }}</td>
            <td>{{ $grade['created_at'] }}</td>
            <td>{{ $grade['updated_at'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }
</style>
