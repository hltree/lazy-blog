import React from 'react'
import ReactDOM from 'react-dom'
import remarkGfm from 'remark-gfm'
import remarkSlug from 'remark-slug'
import remarkToc from 'remark-toc'
import rehypeHighlight from 'rehype-highlight'
import rehypeRaw from 'rehype-raw'
import ReactMarkdown from 'react-markdown'
import {CodeMirrorEditor} from './Editor'
import {func} from "prop-types";

const initialTitle = ``
const initialValue = ``

class CreateEditor extends React.PureComponent {
    constructor(props) {
        super(props)

        this.onControlsChange = this.onControlsChange.bind(this)
        this.onSourceChange = this.onSourceChange.bind(this)
        this.state = {
            title: initialTitle,
            value: initialValue,
            rehypePlugins: [[rehypeHighlight, {ignoreMissing: true}]],
            remarkPlugins: [remarkSlug, remarkToc]
        }
    }

    onSourceChange(evt) {
        this.setState({value: evt.target.value})
    }

    onControlsChange(event) {
        const name = event.target.name
        const checked = event.target.checked

        if (name === 'gfm') {
            this.setState({
                remarkPlugins: (checked ? [remarkGfm] : []).concat(
                    remarkSlug,
                    remarkToc
                )
            })
        } else {
            this.setState({
                rehypePlugins: (checked ? [rehypeRaw] : []).concat(rehypeHighlight)
            })
        }
    }

    render() {
        return (
            <>
                <div className="inner">
                    <div className="editor">

                        <form id="form-md-editor">
                            <CodeMirrorEditor
                                mode="markdown"
                                theme="nord"
                                value={this.state.value}
                                onChange={this.onSourceChange}
                            />
                            <div className="btn btn-primary" id="form-md-editor-submit">Submit !</div>
                        </form>
                    </div>

                    <div className="result">
                        <ReactMarkdown
                            className="markdown-body"
                            remarkPlugins={this.state.remarkPlugins}
                            rehypePlugins={this.state.rehypePlugins}
                        >
                            {this.state.value}
                        </ReactMarkdown>
                    </div>
                </div>
                <form className="controls">
                    <label>
                        <input
                            name="gfm"
                            type="checkbox"
                            onChange={this.onControlsChange}
                        />{' '}
                        Use <code>remark-gfm</code>
                        <span className="show-big"> (to enable GFM)</span>
                    </label>
                    <label>
                        <input
                            name="raw"
                            type="checkbox"
                            onChange={this.onControlsChange}
                        />{' '}
                        Use <code>rehype-raw</code>
                        <span className="show-big"> (to enable HTML)</span>
                    </label>
                </form>
            </>
        )
    }
}

function activeLoading() {
    const loadingElm = document.getElementById('loading')
    if (loadingElm) {
        loadingElm.classList.add('anim')
        loadingElm.classList.add('active')
    }
}

function deactivateLoading() {
    const loadingElm = document.getElementById('loading')
    if (loadingElm) {
        loadingElm.addEventListener('transitionend', function f() {
            loadingElm.classList.remove('active')
            this.removeEventListener('transitionend', f)
        })
        setTimeout(function() {
            loadingElm.classList.remove('anim')
        }, 500)
    }
}

const editorElm = document.querySelector('#editor')
if (editorElm) {
    ReactDOM.render(<CreateEditor/>, editorElm)
}

/**
 * この処理以外でローディングする必要ないので、elseで分岐する
 * @type {Element}
 */
const showPostElm = document.querySelector('#showPost')
if (showPostElm) {
    const postId = showPostElm.dataset.postId
    if (postId) {
        fetch(`/api/post/${postId}`, {
            method: 'GET'
        }).then(function (response) {
            return response.json()
        }).then(function (json) {
            return new Promise(function (resolve, reject) {
                ReactDOM.render(
                    <ReactMarkdown remarkPlugins={[remarkGfm, remarkSlug, remarkToc]}
                                   rehypePlugins={[rehypeHighlight, rehypeRaw, {ignoreMissing: true}]}
                    >{json.post_content}</ReactMarkdown>, document.querySelector('#showPost'), function () {
                        resolve()
                    })
            })
        }).then(function () {
            deactivateLoading()
        })
    }
} else {
    deactivateLoading()
}
