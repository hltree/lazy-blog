import React from 'react'
import PropTypes from 'prop-types'

export class CodeMirrorEditor extends React.Component {
    constructor(props) {
        super(props)
        this.handleChange = this.handleChange.bind(this)
        this.editorRef = React.createRef()
    }

    componentDidUpdate() {
        if (!this.editor) return

        if (this.props.value && this.editor.getValue() !== this.props.value) {
            this.editor.setValue(this.props.value)
        }
    }

    handleChange() {
        if (!this.editor) return

        const value = this.editor.getValue()

        if (value === this.props.value) return

        if (this.props.onChange) {
            this.props.onChange({target: {value}})
        }

        if (this.editor.getValue() !== this.props.value) {
            this.editor.setValue(this.props.value)
        }
    }

    render() {
        return (
            <textarea
                ref={this.editorRef}
                value={this.props.value}
                onChange={this.props.onChange}
                name="post_content"
                placeholder="# This is Preview Area!"
            />
        )
    }
}

CodeMirrorEditor.propTypes = {
    onChange: PropTypes.func.isRequired,
    value: PropTypes.string.isRequired
}
