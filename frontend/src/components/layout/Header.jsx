import React from "react";
import { Link } from "react-router-dom";

const Header = props => {
  return (
    <nav className="navbar navbar-expand-sm navbar-dark bg-danger mb-3">
      <div className="container">
        <Link className="navbar-brand" to="/">
          {props.header}
        </Link>

        <ul className="navbar-nav ml-auto">
          <li className="nav-item">
            <Link to="/" className="nav-link">
              <i className="fa fa-home"></i> Search
            </Link>
          </li>
          <li className="nav-item">
            <Link className="nav-link" to="items/add">
              <i className="fa fa-plus"></i> Add Item
            </Link>
          </li>
          <li className="nav-item">
            <Link className="nav-link" to="about">
              <i className="fa fa-question"></i> Items
            </Link>
          </li>
        </ul>
      </div>
    </nav>
  );
};

Header.defaultProps = {
  header: "Items"
};

export default Header;
