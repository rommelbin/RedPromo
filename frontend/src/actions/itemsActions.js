import axios from 'axios';

export const getItems = () => async dispatch => {
  const response = await axios.get(
    "https://jsonplaceholder.typicode.com/users"
  );
  dispatch({
    type: "GET_ITEMS",
    payload: response.data
  });
};

export const getItem = id => async dispatch => {
  const response = await axios.get(
    `https://jsonplaceholder.typicode.com/users/${id}`
  );
  dispatch({
    type: "GET_ITEM",
    payload: response.data
  });
};

export const deleteItem = id => async dispatch => {
  await axios.delete(`https://jsonplaceholder.typicode.com/users/${id}`);
  dispatch({
    type: "DELETE_ITEM",
    payload: id
  });
};

export const addItem = Item => async dispatch => {
  const response = await axios.post(
    "https://jsonplaceholder.typicode.com/users/",
    Item
  );
  dispatch({
    type: "ADD_ITEM",
    payload: response.data
  });
};

export const updateItem = Item => async dispatch => {
  const response = await axios.put(
    `https://jsonplaceholder.typicode.com/users/${Item.id}`,
    Item
  );
  dispatch({
    type: "UPDATE_ITEM",
    payload: response.data
  });
};
