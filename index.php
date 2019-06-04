<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>The Periodic Table API Documentation</h2>
				
<table>
  <tr>
    <th>Route</th>
    <th>Server Method</th>
    <th>Type</th>
	<th>Posted JSON Example</th>
	<th>Description</th>
  </tr>
  <tr>
    <td>/elements</td>
    <td>GET</td>
    <td>JSON</td>
	<td><code>N/A</code></td>
	<td>Return all elements from the periodic table</td>
  </tr>
  <tr>
    <td>/elements/{id/Symbol}</td>
    <td>GET</td>
    <td>JSON</td>
	<td><code>N/A</code></td>
	<td>Return a single element from the periodic table using either the element id or element symbol</td>
  </tr>
  <tr>
    <td>/elements</td>
    <td>POST</td>
    <td>JSON</td>
	<td><code>{"atomic_symbol":"O",
		"element_name":"oxygen",
		"atomic_mass":"15.9994",
		"melting_point_in_C":"-218",
		"boiling_point_in_C":"-183","source":"Air",
		"colour":"colorless",
		"uses":"rocket fuel, steel"}
		</code></td>
	<td>Insert a new element record into the database</td>
  </tr>
  <tr>
    <td>/elements</td>
    <td>PUT</td>
    <td>JSON</td>
	<td><code>{"atomic_id":"8",
	"atomic_symbol":"O",
	"element_name":"oxygen",
	"atomic_mass":"15.9994",
	"melting_point_in_C":"-218",
	"boiling_point_in_C":"-183","source":"Air",
	"colour":"colorless",
	"uses":"rocket fuel, steel"}
	</code></td>
	<td>Update an existing element record residing in the database</td>
  </tr>
  <tr>
    <td>/elements</td>
    <td>DELETE</td>
    <td>JSON</td>
	<td><code>{"id" : 59}</code></td>
	<td>Delete an existing element record from the database</td>
  </tr>
</table>

</body>
</html>
