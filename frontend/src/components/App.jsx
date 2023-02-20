import React, { Component } from "react";
import { HashRouter as Router, Switch, Route } from "react-router-dom";
import { Provider } from "react-redux";
import store from "../store";

import Header from "./layout/Header";
import About from "./pages/About";
import AddItem from "./items/AddItem";
import NotFound from "./pages/NotFound";
import EditItem from "./items/EditItem";
import Items from "./items/Items";

class App extends Component {
  state = {};
  render() {
    return (
      <Provider store={store}>
        <Router>
          <React.Fragment>
            <Header />
            <div className="container">
              <Switch>
                <Route exact path="/" component={Items} />
                <Route exact path="/about/" component={About} />
                <Route exact path="/item/add/" component={AddItem} />
                <Route exact path="/item/edit/:id" component={EditItem} />
                <Route component={NotFound} />
              </Switch>
            </div>
          </React.Fragment>
        </Router>
      </Provider>
    );
  }
}

export default App;
