import React, { Component } from "react";
import { connect } from "react-redux";
import { getItems } from "../../actions/itemsActions";
import Item from "./Item";

class Items extends Component {
  componentDidMount() {
    this.props.getItems();
  }

  render() {
    return (
      <React.Fragment>
        <h1 className="mb-3">
          <span className="text-danger">Item</span> List
        </h1>
        {this.props.items.map(item => (
          <Item item={item} key={item.id} />
        ))}
      </React.Fragment>
    );
  }
}

const mapStateToProps = state => ({
  items: state.item.items
});

export default connect(
  mapStateToProps,
  { getItems }
)(Items);
