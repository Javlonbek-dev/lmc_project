<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Duration</th>
        <th>Course ID</th>
        <th>Course Title</th>
        <th>Created At</th>
        <th>Updated At</th>
    </tr>
    </thead>
    <tbody>
    @foreach($quizzes as $quiz)
        <tr>
            <td>{{ $quiz['id'] }}</td>
            <td>{{ $quiz['title'] }}</td>
            <td>{{ $quiz['description'] }}</td>
            <td>{{ $quiz['duration'] }}</td>
            <td>{{ $quiz['course']['id'] }}</td>
            <td>{{ $quiz['course']['title'] }}</td>
            <td>{{ $quiz['created_at'] }}</td>
            <td>{{ $quiz['updated_at'] }}</td>
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
