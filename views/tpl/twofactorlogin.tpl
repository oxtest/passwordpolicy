<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
[{capture append="oxidBlock_content"}]
<form class="form-horizontal" action="[{$oViewConf->getSslSelfLink()}]" name="order" method="post" novalidate="novalidate">
    <div class="hidden">
        [{$oViewConf->getHiddenSid()}]
        [{$oViewConf->getNavFormParams()}]
        <input type="hidden" name="fnc" value="finalizeLogin">
        <input type="hidden" name="cl" value="twofactorlogin">
    </div>
    <div class="mt-3 flex justify-center " id="OTPInput">
    </div>
    <input hidden id="otp" name="otp" value="">
    <div class="flex justify-center">
            <button id="accUserSaveTop" type="submit" name="save" class="mt-10 btn btn-primary">[{oxmultilang ident="SAVE"}]</button>
</div>
</form>
    [{oxscript include=$oViewConf->getModuleUrl('oxpspasswordpolicy','src/js/otpField.js')}]
[{/capture}]


[{include file="layout/page.tpl"}]