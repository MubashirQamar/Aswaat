
<html>
    <body>
        <table style="border: 1px solid black">
            <tr>
                <td>Name</td>
                <td>{{ $data['name'] }}</td>
            </tr>
            <tr>
                <td>Company Name</td>
                <td>{{ $data['company_name'] }}</td>
            </tr>
            <tr>
                <td>City</td>
                <td>{{ $data['city'] }}</td>
            </tr>
            <tr>
                <td>Country</td>
                <td>{{ $data['country'] }}</td>
            </tr>
            <tr>
                <td>Phone Number</td>
                <td>{{ $data['phone_number'] }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>{{ $data['email'] }}</td>
            </tr>
            <tr>
                <td>Message</td>
                <td>{{ $data['message'] }}</td>
            </tr>
        </table>
    </body>
</html>
