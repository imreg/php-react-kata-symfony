import React, {Component} from "react";
import ReactDOM from 'react-dom';
import {Provider} from 'react-redux';
import * as action from './Redux/Actions/index'
import configureStore from "./Redux/Store/index";
import QuotaTable from './Components/Quota/QuotaTable'
import QuotaAddNew from "./Components/Quota/QuotaAddNew";

const store = configureStore();
store.dispatch(action.fetchAllRecords());

const styles = (theme) => ({
    root: {
        flexGrow: 1,
    },
});

class Quota extends Component {
    render() {
        return (
            <div className={styles.root}>
                <QuotaTable/>
                <QuotaAddNew/>
            </div>
        )
    }
}

ReactDOM.render(
    <Provider store={store}>
        <Quota/>
    </Provider>
    , document.getElementById("quota"));
