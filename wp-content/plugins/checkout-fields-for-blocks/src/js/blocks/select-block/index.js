/**
 * External dependencies
 */
import { SVG } from '@wordpress/components';
import { registerBlockType } from '@wordpress/blocks';

/**
 * Internal dependencies
 */
import { Edit } from './edit';
import { Save } from '../../components/Save';
import metadata from './block.json';

registerBlockType(metadata, {
	icon: {
		src: (
			<SVG
				version="1.2"
				xmlns="http://www.w3.org/2000/svg"
				viewBox="0 0 74 74"
				width="70"
				height="70"
			>
				<defs>
					<image
						width="71"
						height="58"
						id="img1"
						href="data:image/png;base64,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"
					/>
				</defs>
				<style></style>
				<use href="#img1" x="1" y="7" />
			</SVG>
		),
	},
	edit: Edit,
	save: Save,
});
