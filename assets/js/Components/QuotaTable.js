import React from 'react';
import axios from 'axios';
import PropTypes from 'prop-types';
import {withStyles} from '@material-ui/core/styles';
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';

import QuotaTableRows from './QuotaTableRows';

const styles = theme => ({
    root: {
        width: '100%',
        marginTop: theme.spacing.unit * 3,
        overflowX: 'auto',
    },
    table: {
        minWidth: 700,
    },
});

class QuotaTable extends React.Component {
    constructor() {
        super();

        this.state = {
            dataSet: [],
        };
    }

    componentDidMount() {
        axios.get('/api/all')
            .then(response => {
                console.log(response.data);
                this.setState({dataSet: response.data});
            })
            .catch(function (error) {
                console.log(error);
            })
    }

    tabRow() {
        return this.state.dataSet.map(function (object, i) {
            return <QuotaTableRows obj={object} key={i}/>;
        });
    }


    render() {
        return (
            <Paper className={styles.root}>
                <Table className={styles.table}>
                    <TableHead>
                        <TableRow>
                            <TableCell>Id</TableCell>
                            <TableCell align="right">Reference Number</TableCell>
                            <TableCell align="right">Description</TableCell>
                            <TableCell align="right">Premium Amount</TableCell>
                            <TableCell align="right">Created</TableCell>
                        </TableRow>
                    </TableHead>
                    <TableBody>
                        {this.tabRow()}
                    </TableBody>
                </Table>
            </Paper>
        );
    }
}

export default QuotaTable;
