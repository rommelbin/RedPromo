import React, { Component } from "react";
import TextInputGroup from "../layout/TextInputGroup";
import PropTypes from "prop-types";
import { connect } from "react-redux";
import { getItem, updateItem } from "../../actions/itemsActions";

class EditItem extends Component {
  state = {
    name: "",
    email: "",
    phone: "",
    errors: {}
  };

  UNSAFE_componentWillReceiveProps(nextProps, nextState) {
    const { name, email, phone } = nextProps.item;
    this.setState({
      name,
      email,
      phone
    });
  }

  componentDidMount() {
    const { id } = this.props.match.params;
    this.props.getItem(id);
  }

  onSubmit = e => {
    e.preventDefault();

    const { name, email, phone } = this.state;

    // Check For Errors
    if (name === "") {
      this.setState({ errors: { name: "Name is required" } });
      return;
    }

    if (email === "") {
      this.setState({ errors: { email: "Email is required" } });
      return;
    }

    if (phone === "") {
      this.setState({ errors: { phone: "Phone is required" } });
      return;
    }

    const { id } = this.props.match.params;

    const updItem = {
      id,
      name,
      email,
      phone
    };

    this.props.updateItem(updItem);

    // Clear State
    this.setState({
      name: "",
      email: "",
      phone: "",
      errors: {}
    });

    this.props.history.push("/");
  };

  onChange = e => this.setState({ [e.target.name]: e.target.value });

  render() {
    const { name, category_id, errors } = this.state;

    return (
      <div className="card mb-3">
        <div className="card-header">Edit Item</div>
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
              value="Update Item"
              className="btn btn-light btn-block"
            />
          </form>
        </div>
      </div>
    );
  }
}

EditItem.propTypes = {
  item: PropTypes.object.isRequired,
  getItem: PropTypes.func.isRequired
};

const mapStateToProps = state => ({
  item: state.item.item
});

export default connect(
  mapStateToProps,
  { getItem, updateItem }
)(EditItem);
