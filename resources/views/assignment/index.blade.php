<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Due Date</th>
        <th>Max Score</th>
        <th>Course ID</th>
        <th>Course Title</th>
        <th>Course Description</th>
        <th>Created At</th>
        <th>Updated At</th>
    </tr>
    </thead>
    <tbody>
    @foreach($assignments as $assignment)
        <tr>
            <td>{{ $assignment['id'] }}</td>
            <td>{{ $assignment['title'] }}</td>
            <td>{{ $assignment['description'] }}</td>
            <td>{{ $assignment['due_date'] }}</td>
            <td>{{ $assignment['max_score'] }}</td>
            <td>{{ $assignment['course']['id'] }}</td>
            <td>{{ $assignment['course']['title'] }}</td>
            <td>{{ $assignment['course']['description'] }}</td>
            <td>{{ $assignment['created_at'] }}</td>
            <td>{{ $assignment['updated_at'] }}</td>
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
