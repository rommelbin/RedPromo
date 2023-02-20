import React, { Component } from "react";
import { Link } from "react-router-dom";
import { connect } from "react-redux";
import { deleteItem } from "../../actions/itemsActions";

class Item extends Component {
  state = {
    showItemInfo: false
  };

  render() {
    const { id, name, category_id } = this.props.item;
    return (
      <div className="card mb-2">
        <div className="card-header">
          <h4>
            {name}
            <i
              className="fa fa-sort-down ml-2"
              style={{ cursor: "pointer" }}
              onClick={() =>
                this.setState({
                  showItemInfo: !this.state.showItemInfo
                })
              }
            ></i>
            <i
              className="fa fa-times"
              style={{ cursor: "pointer", float: "right", color: "red" }}
              onClick={() => this.props.deleteItem(id)}
            ></i>
            <Link to={`item/edit/${id}`}>
              <i
                className="fa fa-pencil"
                style={{
                  cursor: "pointer",
                  float: "right",
                  color: "black",
                  marginRight: "1rem"
                }}
              />
            </Link>
          </h4>
        </div>
        {this.state.showItemInfo ? (
          <div className="card-body">
            <ul className="list-group">
              <li className="list-group-item">Category_id: {category_id}</li>
            </ul>
          </div>
        ) : null}
      </div>
    );
  }
}

export default connect(
  null,
  { deleteItem }
)(Item);
