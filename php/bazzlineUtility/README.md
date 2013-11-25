PHP_Bazzline_Utility
====================

This repository is deprecated.  
Lock is separated to: https://packagist.org/packages/net_bazzline/component_lock  
Shutdown is separated to: https://packagist.org/packages/net_bazzline/component_shutdown

General
=======
Utility repository for php bazzline namespace.

This repository holds a number of utilites. 

Each utility is covered with a unittests and a least one example.  
The unittest and the examples should give you a quick look on how the utility class should be used.

List Of Utilities
=================
[name]					[description]   
ChunkIterator				can be used to chunk over a given number of entries until all are processed or limit is reached.   
					hint: the native array_chunk maybe fits your needs also and is faster since it is a core function.   
