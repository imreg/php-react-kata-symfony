import React, {Component} from "react";
import PropTypes from 'prop-types';
import {withStyles} from '@material-ui/core/styles';
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';

import TodoTableRows from './QuotaTableRows';
import {connect} from 'react-redux';

const styles = (theme) => ({
    root: {
        width: '100%',
        marginTop: theme.spacing.unit * 3,
        overflowX: 'auto',
    },
    table: {
        minWidth: 700,
    },
});

function mapStateToProps(state) {
     return {records: state.records};
}

class QuotaTable extends Component {
    constructor() {
        super();
    }

    tabRow() {
        return this.props.records.map(function (object, i) {
             return <TodoTableRows obj={object} key={i}/>;
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

export default connect(mapStateToProps, null)(QuotaTable);
