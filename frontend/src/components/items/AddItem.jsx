import React, { Component } from "react";
import { connect } from "react-redux";
import TextInputGroup from "../layout/TextInputGroup";
import { addItem } from "../../actions/itemsActions";

class AddItem extends Component {
  state = {
    name: "",
    category_id: "",
    errors: {}
  };

  onSubmit = e => {
    e.preventDefault();

    const { name, category_id } = this.state;

    // Check For Errors
    if (name === "") {
      this.setState({ errors: { name: "Name is required" } });
      return;
    }

    if (category_id === "") {
      this.setState({ errors: { category_id: "Category is required" } });
      return;
    }

    const newItem = {
      name,
      category_id
    };

    this.props.addItem(newItem);

    // Clear State
    this.setState({
      name: "",
      category_id: "",
      errors: {}
    });

    //Redirect to home
    this.props.history.push("/");
  };

  onChange = e => this.setState({ [e.target.name]: e.target.value });

  render() {
    const { name, category_id, errors } = this.state;

    return (
      <div className="card mb-3">
        <div className="card-header">Add Item</div>
        <div className="card-body">
          <form onSubmit={this.onSubmit}>
            <TextInputGroup
              label="Name"
              name="name"
              placeholder="Enter Name"
              value={name}
              onChange={this.onChange}
              error={errors.name}
            />
            <TextInputGroup
              label="category_id"
              name="category_id"
              placeholder="Enter category_id"
              value={category_id}
              onChange={this.onChange}
              error={errors.category_id}
            />
            <input
              type="submit"
              value="Add Item"
              className="btn btn-light btn-block"
            />
          </form>
        </div>
      </div>
    );
  }
}

export default connect(
  null,
  { addItem }
)(AddItem);
