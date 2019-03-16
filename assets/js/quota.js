import React, { Component } from "react";
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import * as action from './Redux/Actions/index'
import configureStore from "./Redux/Store/index";
import QuotaTable from './Components/Quota/QuotaTable'
import QuotaAddNew from "./Components/Quota/QuotaAddNew";

const store = configureStore();
store.dispatch(action.fetchAllRecords());

class Quota extends Component {
    render() {
        return (
            <div>
                <QuotaTable />
                <QuotaAddNew />
            </div>
        )
    }
}

ReactDOM.render(
    <Provider store={store}>
        <Quota/>
    </Provider>
    , document.getElementById("quota"));
