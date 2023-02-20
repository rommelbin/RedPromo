const initialState = {
  items: [],
  item: {}
};

export default function(state = initialState, action) {
  switch (action.type) {
    case "GET_ITEMS":
      return { ...state, items: action.payload };
    case "GET_ITEM":
      return { ...state, item: action.payload };
    case "DELETE_ITEM":
      return {
        ...state,
        items: state.items.filter(
          item => item.id !== action.payload
        )
      };
    case "ADD_ITEM":
      return { ...state, items: [action.payload, ...state.items] };
    case "UPDATE_ITEM":
      return {
        ...state,
        items: state.items.map(item =>
          item.id === action.payload.id
            ? (item = action.payload)
            : item
        )
      };
    default:
      return state;
  }
}
