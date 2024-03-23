<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>User Name</th>
        <th>Course ID</th>
        <th>Course Title</th>
        <th>Course Description</th>
        <th>Enrollment Date</th>
        <th>Created At</th>
        <th>Updated At</th>
    </tr>
    </thead>
    <tbody>
    @foreach($enrollments as $enrollment)
        <tr>
            <td>{{ $enrollment['id'] }}</td>
            <td>{{ $enrollment['user']['name'] }}</td>
            <td>{{ $enrollment['course']['id'] }}</td>
            <td>{{ $enrollment['course']['title'] }}</td>
            <td>{{ $enrollment['course']['description'] }}</td>
            <td>{{ $enrollment['enrollment_date'] }}</td>
            <td>{{ $enrollment['created_at'] }}</td>
            <td>{{ $enrollment['updated_at'] }}</td>
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
