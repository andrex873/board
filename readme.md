# Board

Board is a RESTful API application created with [Laravel Framework](https://laravel.com/) to administrate boards and notes.

## Install
* Clone the repo: `git clone https://github.com/andrex873/board`.
* To run the application Follow the [board-docker](https://github.com/andrex873/board-docker) instructions.

## Documentation

### Board

#### List all Boards

To retrieve a list of all of the Borads, send a `GET` request to `/api/v1/boards`.

**Response body:**
```json
{
    "status_code": 200,
    "data": [
    {
        "id": "1",
        "name": "Naomie Gislason",
        "last_update": "2016-05-10 15:19:20",
        "actions": {
            "show": "http://localhost:1080/api/v1/boards/1",
            "delete": "http://localhost:1080/api/v1/boards/1"
        }
    },
    {
        "id": "2",
        "name": "Marie McGlynn",
        "last_update": "2016-05-10 15:19:20",
        "actions": {
            "show": "http://localhost:1080/api/v1/boards/2",
            "delete": "http://localhost:1080/api/v1/boards/2"
        }
    },
    {
        "id": "3",
        "name": "Rashawn Thiel",
        "last_update": "2016-05-10 15:19:20",
        "actions": {
            "show": "http://localhost:1080/api/v1/boards/3",
            "delete": "http://localhost:1080/api/v1/boards/3"
        }
    }
    ]
}
```

#### Create a new Board

To create a new Board, send a `POST` request to `/api/v1/boards`. Set the "name" attribute to the Board name you are adding.

**Request data**
<table>
    <tr>
        <th>name</th>
        <th>type</th>
        <th>description</th>
    </tr>
    <tr>
        <td>name</td>
        <td>string</td>
        <td>The name for the new Board that you are creating.</td>
    </tr>
</table>

**Response body**
```json
{
   "status_code":200,
   "data":{
      "id":11,
      "name":"This is a new board created just now.",
      "last_update":"2016-05-11 17:59:51",
      "actions":{
         "show":"http://localhost:1080/api/v1/boards/11",
         "delete":"http://localhost:1080/api/v1/boards/11"
      }
   }
}
```

#### Retrieve an existing Board

To get details about a specific Board, send a `GET` request to `/api/v1/boards/$BOARD_ID`.

**Response body**
```json
{
   "status_code":200,
   "data":{
      "id":"11",
      "name":"This is a new board created just now.",
      "last_update":"2016-05-11 17:59:51",
      "actions":{
         "show":"http://localhost:1080/api/v1/boards/11",
         "delete":"http://localhost:1080/api/v1/boards/11"
      }
   }
}
```

#### Delete a Board

To delete a Board, send a `DELETE` request to `/api/v1/boards/$BOARD_ID`.

The Board will be removed and a response status of `204` will be returned. This indicates a successful request with no response body.

### Notes

#### List all Notes

To retrieve a list of all of the Notes that belongs to a Board, send a `GET` request to `/api/v1/boards/$BOARD_ID/notes`.

**Response body**
```json
{
   "status_code":200,
   "data":[
      {
         "id":"50",
         "board_id":"5",
         "type":"WELL",
         "body":"Omnis quasi autem minima magni sunt quasi dicta. Qui blanditiis enim sunt aut reiciendis blanditiis. Enim magni et est non laudantium. Ipsum molestiae sunt dolor exercitationem nostrum maxime",
         "votes":"-2",
         "actions":{
            "show":"http://localhost:1080/api/v1/boards/5/notes/50",
            "delete":"http://localhost:1080/api/v1/boards/5/notes/50"
         }
      },
      {
         "id":"52",
         "board_id":"5",
         "type":"WRON",
         "body":"Sunt sunt consequatur impedit facilis facere est. Asperiores ut quis est dignissimos dolore. Labore fugit nulla magnam facere aliquam. Officiis reprehenderit similique voluptatem blanditiis. Ipsam architecto aperiam odio necessitatibus. Distinctio impedit",
         "votes":"11",
         "actions":{
            "show":"http://localhost:1080/api/v1/boards/5/notes/52",
            "delete":"http://localhost:1080/api/v1/boards/5/notes/52"
         }
      },
      {
         "id":"61",
         "board_id":"5",
         "type":"WRON",
         "body":"Dolorum eos cupiditate totam quia rerum esse repellendus. Ratione recusandae est dolores et excepturi rerum repellendus. In voluptatum vel in ut. Et temporibus eius aspernatur dolor dolor sit aliquid.",
         "votes":"9",
         "actions":{
            "show":"http://localhost:1080/api/v1/boards/5/notes/61",
            "delete":"http://localhost:1080/api/v1/boards/5/notes/61"
         }
      }
   ]
}
```

#### Create a new Note

To create a new Note that belongs to a Board, send a `POST` request to `/api/v1/boards/$BOARD_ID/notes`. Set the "type", "body" and "votes" attributes to the Note you are adding.

**Request data**
<table>
    <tr>
        <th>name</th>
        <th>type</th>
        <th>Description</th>
    </tr>
    <tr>
        <td>type</td>
        <td>string</td>
        <td>One of this values 'WELL', 'WRON' or 'AITEM'</td>
    </tr>
    <tr>
        <td>body</td>
        <td>string</td>
        <td>The content of the Note.</td>
    </tr>
    <tr>
        <td>votes</td>
        <td>numeric</td>
        <td>The number of the votes for the Note.</td>
    </tr>
</table>

**Response body**
```json
{
   "status_code":200,
   "data":{
      "id":82,
      "board_id":"5",
      "type":"WELL",
      "body":"The new feature is just amazing, the team work really well.",
      "votes":"6",
      "actions":{
         "show":"http://localhost:1080/api/v1/boards/5/notes/82",
         "delete":"http://localhost:1080/api/v1/boards/5/notes/82"
      }
   }
}
```

#### Retrieve an existing Note

To get details about a specific Note that belongs to a Board, send a `GET` request to `/api/v1/boards/$BOARD_ID/notes/$NOTE_ID`.

**Response body**
```json
{
   "status_code":200,
   "data":{
      "id":"82",
      "board_id":"5",
      "type":"WELL",
      "body":"The new feature is just amazing, the team work really well.",
      "votes":"6",
      "actions":{
         "show":"http://localhost:1080/api/v1/boards/5/notes/82",
         "delete":"http://localhost:1080/api/v1/boards/5/notes/82"
      }
   }
}
```

#### Update a Note

To update a Note that belongs to a Board, send a `PUT` request to `/api/v1/boards/$BOARD_ID/notes/$NOTE_ID`. Set the "type", "body" and "votes" attributes to the Note you are updating.

**Request data**
<table>
    <tr>
        <th>name</th>
        <th>type</th>
        <th>Description</th>
    </tr>
    <tr>
        <td>type</td>
        <td>(optional) string</td>
        <td>One of this values 'WELL', 'WRON' or 'AITEM'</td>
    </tr>
    <tr>
        <td>body</td>
        <td>(optional) string</td>
        <td>The content of the Note.</td>
    </tr>
    <tr>
        <td>votes</td>
        <td>(optional) numeric</td>
        <td>The number of the votes for the Note.</td>
    </tr>
</table>

**Response body**
```json
{
   "status_code":200,
   "data":{
      "id":"82",
      "board_id":"5",
      "type":"WELL",
      "body":"The new feature is just amazing, the team work really well.",
      "votes":"5",
      "actions":{
         "show":"http://localhost:1080/api/v1/boards/5/notes/82",
         "delete":"http://localhost:1080/api/v1/boards/5/notes/82"
      }
   }
}
```

#### Add votes to a Note

To add votes to a Note that belongs to a Board, send a `PUT` request to `/api/v1/boards/$BOARD_ID/notes/$NOTE_ID/add/votes`. Set the optional "votes" attribute to the Note you are increasing, if you don't set the "votes" attribute the default increasing value is going to be `1`.

**Request data**
<table>
    <tr>
        <th>name</th>
        <th>type</th>
        <th>Description</th>
    </tr>
    <tr>
        <td>votes</td>
        <td>(optional) numeric</td>
        <td>The number of the votes to add to the Note. If the votes value is not present the default value is going to be 1. If you want substrac votes, send negative values like -1 ... -5 ... -n.</td>
    </tr>
</table>

**Response body**
```json
{
   "status_code":200,
   "data":{
      "id":"82",
      "board_id":"5",
      "type":"WELL",
      "body":"The new feature is just amazing, the team work really well.",
      "votes":7,
      "actions":{
         "show":"http://localhost:1080/api/v1/boards/5/notes/82",
         "delete":"http://localhost:1080/api/v1/boards/5/notes/82"
      }
   }
}
```

#### Delete a Note

To delete a Note that belongs to a Board, send a `DELETE` request to `/api/v1/boards/$BOARD_ID/notes/$NOTE_ID`

## Creators

**Andrés Méndez**

* <https://twitter.com/es_mendez>
* <https://github.com/andrex873>