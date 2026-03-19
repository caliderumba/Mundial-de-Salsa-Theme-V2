( function( blocks, element, editor ) {
    var el = element.createElement;
    var RichText = editor.RichText;

    blocks.registerBlockType( 'mds-pro/event-info', {
        title: 'MDS: Info de Evento',
        icon: 'calendar-alt',
        category: 'layout',
        attributes: {
            content: {
                type: 'string',
                source: 'html',
                selector: 'p',
            },
        },
        edit: function( props ) {
            var content = props.attributes.content;
            function onChangeContent( newContent ) {
                props.setAttributes( { content: newContent } );
            }

            return el(
                'div',
                { className: 'mds-event-info-block bg-emerald-50 p-6 rounded-2xl border-2 border-emerald-500' },
                el( 'h4', { className: 'text-emerald-700 font-bold mb-2' }, 'Información del Evento' ),
                el( RichText, {
                    tagName: 'p',
                    className: 'text-emerald-900',
                    onChange: onChangeContent,
                    value: content,
                    placeholder: 'Escribe los detalles del evento aquí...',
                } )
            );
        },
        save: function( props ) {
            return el(
                'div',
                { className: 'mds-event-info-block bg-emerald-50 p-6 rounded-2xl border-2 border-emerald-500 my-8' },
                el( 'h4', { className: 'text-emerald-700 font-bold mb-2' }, 'Información del Evento' ),
                el( RichText.Content, {
                    tagName: 'p',
                    className: 'text-emerald-900',
                    value: props.attributes.content,
                } )
            );
        },
    } );
} )(
    window.wp.blocks,
    window.wp.element,
    window.wp.editor
);
