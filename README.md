# yii2-validators

composer require qdzsoft/yii2-validators

## config in model

[['gene_seq'], \qdzsoft\validators\OrfValidator::className()],
[['protein_seq'], \qdzsoft\validators\ProteinValidator::className()],
[['gene_seq', 'protein_seq'], \qdzsoft\validators\EitherValidator::className()]
