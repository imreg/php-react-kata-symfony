import React, {Component} from "react";
import PropTypes from 'prop-types';
import {withStyles} from '@material-ui/core/styles';
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';
import Grid from '@material-ui/core/Grid';

import TodoTableRows from './QuotaTableRows';

import {connect} from 'react-redux';

const styles = (theme) => ({
    root: {
        flexGrow: 1,
    },
    paper: {
        padding: theme.spacing.unit * 2,
        textAlign: 'center',
        color: theme.palette.text.secondary,
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
                <Grid container spacing={24}>
                    <Grid item xs={12}>
                        <Paper className={styles.paper}>
                            <Table className={styles.table}>
                                <TableHead>
                                    <TableRow>
                                        <TableCell></TableCell>
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
                    </Grid>
                </Grid>
        );
    }
}

QuotaTable.propTypes = {
    classes: PropTypes.object.isRequired,
};


export default withStyles(styles)(connect(mapStateToProps, null)(QuotaTable));
