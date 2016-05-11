# Board

Board is a RESTful API application created with [Laravel Framework](https://laravel.com/) to administrate boards and notes.

## Install
* Clone the repo: `git clone https://github.com/andrex873/board`.
* To run the application Follow the [board-docker](https://github.com/andrex873/board-docker) instructions.

## Documentation

### Board

**List all Boards**

To retrieve a list of all of the Borads, send a `GET` request to `/api/v1/boards`.

**Create a new Board**

To create a new Board, send a `POST` request to `/api/v1/boards`. Set the "name" attribute to the Board name you are adding.

**Retrieve an existing Board**

To get details about a specific Board, send a `GET` request to `/api/v1/boards/$BOARD_ID`.

**Delete a Board**

To delete a Board, send a `DELETE` request to `/api/v1/boards/$BOARD_ID`

### Notes

**List all Notes**

To retrieve a list of all of the Notes that belongs to a Board, send a `GET` request to `/api/v1/boards/$BOARD_ID/notes`.

**Create a new Note**

To create a new Note that belongs to a Board, send a `POST` request to `/api/v1/boards/$BOARD_ID/notes`. Set the "type", "body" and "votes" attributes to the Note you are adding.

**Retrieve an existing Note**

To get details about a specific Note that belongs to a Board, send a `GET` request to `/api/v1/boards/$BOARD_ID/notes/$NOTE_ID`.

**Update a Note**

To update a Note that belongs to a Board, send a `PUT` request to `/api/v1/boards/$BOARD_ID/notes/$NOTE_ID`. Set the "type", "body" and "votes" attributes to the Note you are updating.

**Add votes to a Note**

To add votes to a Note that belongs to a Board, send a `PUT` request to `/api/v1/boards/$BOARD_ID/notes/$NOTE_ID/add/votes`. Set the optional "votes" attribute to the Note you are increasing, if you don't set the "votes" attribute the default increasing value is going to be `1`.

**Delete a Note**

To delete a Note that belongs to a Board, send a `DELETE` request to `/api/v1/boards/$BOARD_ID/notes/$NOTE_ID`

## Creators

**Andrés Méndez**

* <https://twitter.com/es_mendez>
* <https://github.com/andrex873>