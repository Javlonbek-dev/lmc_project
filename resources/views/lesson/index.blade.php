<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Course ID</th>
        <th>Course Title</th>
        <th>Course Description</th>
        <th>Title</th>
        <th>Description</th>
        <th>Content</th>
        <th>Order</th>
        <th>Created At</th>
        <th>Updated At</th>
    </tr>
    </thead>
    <tbody>
    @foreach($lessons as $lesson)
        <tr>
            <td>{{ $lesson['id'] }}</td>
            <td>{{ $lesson['course']['id'] }}</td>
            <td>{{ $lesson['course']['title'] }}</td>
            <td>{{ $lesson['course']['description'] }}</td>
            <td>{{ $lesson['title'] }}</td>
            <td>{{ $lesson['description'] }}</td>
            <td>{{ $lesson['content'] }}</td>
            <td>{{ $lesson['order'] }}</td>
            <td>{{ $lesson['created_at'] }}</td>
            <td>{{ $lesson['updated_at'] }}</td>
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
