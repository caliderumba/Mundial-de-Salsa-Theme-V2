const { registerBlockType } = wp.blocks;
const { InspectorControls, RichText, InnerBlocks, useBlockProps } = wp.blockEditor;
const { PanelBody, SelectControl, RangeControl, ToggleControl } = wp.components;
const { useSelect } = wp.data;

// Advanced Heading
registerBlockType('mds-pro/advanced-heading', {
    title: 'MDS Advanced Heading',
    icon: 'heading',
    category: 'design',
    attributes: {
        content: { type: 'string', source: 'html', selector: 'h1,h2,h3,h4,h5,h6' },
        tag: { type: 'string', default: 'h2' },
        align: { type: 'string', default: 'left' },
        italic: { type: 'boolean', default: true },
    },
    edit: ({ attributes, setAttributes }) => {
        const blockProps = useBlockProps();
        return (
            <div {...blockProps}>
                <InspectorControls>
                    <PanelBody title="Heading Settings">
                        <SelectControl
                            label="Tag"
                            value={attributes.tag}
                            options={[
                                { label: 'H1', value: 'h1' },
                                { label: 'H2', value: 'h2' },
                                { label: 'H3', value: 'h3' },
                                { label: 'H4', value: 'h4' },
                                { label: 'H5', value: 'h5' },
                                { label: 'H6', value: 'h6' },
                            ]}
                            onChange={(tag) => setAttributes({ tag })}
                        />
                        <SelectControl
                            label="Alignment"
                            value={attributes.align}
                            options={[
                                { label: 'Left', value: 'left' },
                                { label: 'Center', value: 'center' },
                                { label: 'Right', value: 'right' },
                            ]}
                            onChange={(align) => setAttributes({ align })}
                        />
                        <ToggleControl
                            label="Italic"
                            checked={attributes.italic}
                            onChange={(italic) => setAttributes({ italic })}
                        />
                    </PanelBody>
                </InspectorControls>
                <RichText
                    tagName={attributes.tag}
                    value={attributes.content}
                    onChange={(content) => setAttributes({ content })}
                    placeholder="Escribe tu encabezado..."
                    className={`font-black uppercase tracking-tighter leading-none ${attributes.italic ? 'italic' : ''}`}
                    style={{ textAlign: attributes.align }}
                />
            </div>
        );
    },
    save: () => null, // Server-side rendered
});

// Post Grid
registerBlockType('mds-pro/post-grid', {
    title: 'MDS Post Grid',
    icon: 'grid-view',
    category: 'widgets',
    attributes: {
        postsPerPage: { type: 'number', default: 3 },
        columns: { type: 'number', default: 3 },
        category: { type: 'string', default: '' },
        layout: { type: 'string', default: 'grid' },
        imagePos: { type: 'string', default: 'top' },
    },
    edit: ({ attributes, setAttributes }) => {
        const blockProps = useBlockProps();
        const categories = useSelect((select) => {
            return select('core').getEntityRecords('taxonomy', 'category', { per_page: -1 });
        }, []);

        const catOptions = [{ label: 'All Categories', value: '' }];
        if (categories) {
            categories.forEach((cat) => {
                catOptions.push({ label: cat.name, value: cat.slug });
            });
        }

        return (
            <div {...blockProps}>
                <InspectorControls>
                    <PanelBody title="Query Settings">
                        <SelectControl
                            label="Category"
                            value={attributes.category}
                            options={catOptions}
                            onChange={(category) => setAttributes({ category })}
                        />
                        <RangeControl
                            label="Posts per Page"
                            value={attributes.postsPerPage}
                            onChange={(postsPerPage) => setAttributes({ postsPerPage })}
                            min={1}
                            max={12}
                        />
                    </PanelBody>
                    <PanelBody title="Layout Settings">
                        <SelectControl
                            label="Layout"
                            value={attributes.layout}
                            options={[
                                { label: 'Grid', value: 'grid' },
                                { label: 'List', value: 'list' },
                            ]}
                            onChange={(layout) => setAttributes({ layout })}
                        />
                        {attributes.layout === 'grid' && (
                            <RangeControl
                                label="Columns"
                                value={attributes.columns}
                                onChange={(columns) => setAttributes({ columns })}
                                min={1}
                                max={4}
                            />
                        )}
                        <SelectControl
                            label="Image Position"
                            value={attributes.imagePos}
                            options={[
                                { label: 'Top', value: 'top' },
                                { label: 'Left', value: 'left' },
                                { label: 'Right', value: 'right' },
                            ]}
                            onChange={(imagePos) => setAttributes({ imagePos })}
                        />
                        <ToggleControl
                            label="Show Excerpt"
                            checked={attributes.showExcerpt}
                            onChange={(showExcerpt) => setAttributes({ showExcerpt })}
                        />
                        <ToggleControl
                            label="Show Date"
                            checked={attributes.showDate}
                            onChange={(showDate) => setAttributes({ showDate })}
                        />
                        <ToggleControl
                            label="Show Author"
                            checked={attributes.showAuthor}
                            onChange={(showAuthor) => setAttributes({ showAuthor })}
                        />
                    </PanelBody>
                </InspectorControls>
                <div className="mds-pro-block-placeholder border-2 border-dashed border-slate-300 p-8 text-center bg-slate-50 rounded-2xl">
                    <div className="font-black uppercase tracking-tighter text-slate-400 mb-2">MDS Post Grid</div>
                    <p className="text-[10px] font-bold uppercase tracking-widest text-slate-500">
                        {attributes.layout} layout • {attributes.postsPerPage} posts • {attributes.category || 'All'}
                    </p>
                </div>
            </div>
        );
    },
    save: () => null, // Server-side rendered
});

// Container
registerBlockType('mds-pro/container', {
    title: 'MDS Container',
    icon: 'editor-expand',
    category: 'layout',
    attributes: {
        padding: { type: 'string', default: 'py-12' },
        maxWidth: { type: 'string', default: 'max-w-7xl' },
        bgColor: { type: 'string', default: 'transparent' },
    },
    edit: ({ attributes, setAttributes }) => {
        const blockProps = useBlockProps({
            className: `mds-pro-container-editor border-2 border-dashed border-slate-200 rounded-3xl p-6 ${attributes.padding} ${attributes.bgColor}`
        });
        
        return (
            <div {...blockProps}>
                <InspectorControls>
                    <PanelBody title="Container Settings">
                        <SelectControl
                            label="Padding"
                            value={attributes.padding}
                            options={[
                                { label: 'None', value: 'py-0' },
                                { label: 'Small', value: 'py-6' },
                                { label: 'Medium', value: 'py-12' },
                                { label: 'Large', value: 'py-24' },
                            ]}
                            onChange={(padding) => setAttributes({ padding })}
                        />
                        <SelectControl
                            label="Max Width"
                            value={attributes.maxWidth}
                            options={[
                                { label: 'Standard (1280px)', value: 'max-w-7xl' },
                                { label: 'Narrow (896px)', value: 'max-w-4xl' },
                                { label: 'Full Width', value: 'max-w-full' },
                            ]}
                            onChange={(maxWidth) => setAttributes({ maxWidth })}
                        />
                        <SelectControl
                            label="Background Color"
                            value={attributes.bgColor}
                            options={[
                                { label: 'Transparent', value: 'transparent' },
                                { label: 'Light Gray', value: 'bg-slate-50' },
                                { label: 'Dark Slate', value: 'bg-slate-900 text-white' },
                                { label: 'Emerald Accent', value: 'bg-emerald-500 text-white' },
                            ]}
                            onChange={(bgColor) => setAttributes({ bgColor })}
                        />
                    </PanelBody>
                </InspectorControls>
                <div className="text-[10px] font-bold uppercase tracking-widest text-slate-300 mb-6 border-b border-slate-100 pb-2">Container</div>
                <InnerBlocks />
            </div>
        );
    },
    save: () => <InnerBlocks.Content />,
});
